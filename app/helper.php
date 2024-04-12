<?php
use Illuminate\Validation\Rule; 
if(!function_exists('validation'))
{
    function validation($data, $id='null')
    {
    //    return $data->validate(
    //         [
    //             'name' => ['required', 'min:3','max:255'],
    //             'email' => [
    //                 'required',
    //                 Rule::unique('users', 'email')->ignore($id),
    //                 'email'
    //             ],
    //             'phone' => 'required|digits:10',
    //             'gender' => 'required',
    //             'qualification' => 'required',
    //         ],
    //     );
    }
}
?>