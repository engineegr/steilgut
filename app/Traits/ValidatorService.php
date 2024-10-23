<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ValidatorService
{
    public function validate(Request $request)
    {
        if (method_exists($this, 'getValidationRuleList')) {
            $validationRules = $this->getValidationRuleList();
        } else {
            abort(500);
        }
        $validatedParameterList = [];
        foreach ($validationRules as $key => $validation) {
            $validatedParameterList[$key] = $request->validate($validation);
        }

        return $validatedParameterList;
    }
}
