<?php
/**
 * Define the default values for a model when it is passed on a form
 */
function defineDefaultsOf($variable,$array){
	foreach ($array as $attribute => $value){
		if($variable->hasAttribute($attribute)){
			if($variable->$attribute==null){
				$variable->$attribute = $value;
			}
		}
	}
}