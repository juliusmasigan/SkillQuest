<?php

class StudentController extends \BaseController {

	public function register() {
		$posts = Input::all();

		$rules = array(
			'fullName' => 'required',
			'email' => 'required',
			'phone' => 'required|numeric',
			'password' => 'required',
		);
		$validator = Validator::make($posts, $rules);
		$validator->setAttributeNames(array(
			'fullName' => 'Full name',
			'email' => 'Email address',
			'phone' => 'Phone',
			'password' => 'Password',
		));

		//Check if email is already registered.
		$students = Student::where('email', $posts['email'])->get();

		$not_match = ($posts['password'] != $posts['confirmPassword']) ? true:false;
		if($validator->fails() || $not_match || count($students)) {
			$errors = $validator->errors();
			if($not_match) {
				$errors->add('password', 'The Password doesn\'t match.');
			}
			if(count($students)) {
				$errors->add('email', 'The Email is already registered.');
			}

			return Redirect::to('student/register')->withErrors($errors)->withInput($posts);
		}

		//Generate random verification code.
		$ver_code = Registration::gencode();

		//New Student model instance.
		$student = new Student;

		//New Registration model instance.
		$registration = new Registration;

		$student_id = $student->insertGetId(array(
			'full_name' => $posts['fullName'],
			'contact_number' => $posts['phone'],
			'email' => $posts['email'],
			'password' => md5($posts['password']),
		));

		$registration->insert(array(
			'user_id' => $student_id,
			'registration_type' => 'student',
			'verification_code' => $ver_code,
			'status' => 'pending',
		));

		//Generate confirmation link.
		$confirm_link = Registration::confirm_link(array(
			'email' => $posts['email'], 
			'password' => md5($posts['password']),
			'code' => $ver_code,
		), 'student');

		//Send a confirmation email.
		Mail::send('email.registration', array('link' => $confirm_link), function($message) use($posts) {
			$message->to($posts['email'], $posts['fullName']);
			$message->subject('Skillquest Registration Confirmation');
		});

		return Redirect::to('/');
	}

	public function confirm() {
		$posts = Input::all();

		//Get the user's record.
		$student = Student::where('email', $posts['user'])->first();

		if(is_null($student)) {
			$error['user'] = "The user is not yet registered in the system.";
			return Redirect::to("student/confirm/{$posts['user']}/{$posts['key']}")->withInput($posts)->withErrors($error);
		}
		
		//Get the registration confirmation code.
		$registration = Registration::where('user_id', $student->id)
			->where('registration_type', 'student')->where('verification_code', $posts['verification_code'])->first();

		$sys_key = md5($student->email."-".$posts['verification_code']."-".$student->password);
        $key = $posts['key'];

		if(is_null($registration) || ($sys_key != $key)) {
			$error['user'] = "The verification code is invalid.";
            return Redirect::to("student/confirm/{$posts['user']}/{$posts['key']}")->withInput($posts)->withErrors($error);
		}

		//Update the status of the registration to 'approval'.
		$registration->status = 'approval';
		$registration->save();

		return Redirect::to("/");
	}

}