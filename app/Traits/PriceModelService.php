<?php

namespace App\Traits;

trait PriceModelService 
{
	public function getFormatPrice() {
		if (property_exists($this, 'fillable') 
			&& in_array('price', $this->fillable)) {
			// return sprintf("%.1f", $this->price);
			return number_format($this->price, 1, ',');
		}
		
		return number_format(0.0, 1, ',');   
	}
}

?>