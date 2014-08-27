<?php

class Query extends Eloquent {

	protected $table = "queries";

	public $incrementing = true;

	public function answer() {
		return $this->hasMany('Answer');
	}

	public function topic() {
		return $this->belongsTo('Topic');
	}

	public function student() {
		return $this->belongsTo('Student');
	}

}
