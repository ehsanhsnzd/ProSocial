<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/11/18
 * Time: 4:03 PM
 */

return array(
    'Active' => 1,
    'Client_Domain' => 'http://localhost:8080/#',
    'Social_Auth' =>true,
    'Language' => [
        'message'=>  'SocialCore.messages.fa',
        'attribute'=>  'SocialCore.attributes.fa'],
    'messages'=>[
        'en'=>[

            'same'    => 'The :attribute and :other must match.',
            'size'    => 'The :attribute must be exactly :size.',
            'between' => 'The :attribute value :input is not between :min - :max.',
            'in'      => 'The :attribute must be one of the following types: :values',
            'required' => 'We need to know your :attribute address!',
            'unique' => 'This :attribute used before. Try another',
            'pwdIncorrect' => 'Entered password is wrong',
            'pwd' => 'Password',
            'user' => 'User',
            'successChange' => 'Changed successfully.',
            'success' => 'Done successfully',
            'login' => 'Login',
            'register' => 'Register',
            'Unauthorised' => 'Unauthorised'

        ],
        'fa'=>[

            'email'    => ' باید در فرمت :attribute باشد.',
            'same'    => ' و :other باید یکی باشد.',
            'size'    => ':attribute باید در این  :size باشد.',
            'between' => ':attribute مقدار :input نیست بین :min - :max.',
            'in'      => ':attribute باید یکی از types: :values باشد.',
            'required' => ' :attribute را باید وارد کنید',
            'unique' => 'این :attribute قبلا استفاده شده.',
            'min' => ':attribute باید حداقل :min کاراکتر باشد',
            'pwdIncorrect' => 'پسورد وارد شده اشتباه است',
            'pwd' => 'پسورد',
            'user' => 'کاربر',
            'successChange' => ' با موفقیت تغییر یافت.',
            'success' => ' با موفقیت انجام شد.',
            'login' => 'ورود',
            'register' => 'عضویت',
            'Unauthorised' => 'اطلاعات ورود نادرست'

        ]],
    'attributes' =>[
        'en' => [
            'email' => 'email address',
        ],
        'fa' => [
            'name' => 'نام',
            'last_name' => 'نام خانوادگی',
            'email' => 'ایمیل',
            'country_id' => 'کشور',
            'state_id' => 'استان',
            'city_id' => 'شهر',
            'zip' => 'کد پستی',
            'description' => 'توضیحات',
            'album_id' => 'آلبوم',
            'image_id' => 'تصویر',
            'phone' => 'تلفن',
            'address' => 'آدرس',
            'password' => 'پسورد',
            'c_password' => 'پسورد دوم',
            'title' => 'عنوان',
            'message' => 'پیغام',
            'to' => 'مقصد',
            'company_name' => 'ایمیل',
            'job_type_id' => 'نوع شغل',
            'job_from_id' => 'از تاریخ شغل',
            'job_to_id' => 'تا تاریخ شغل',
            'school' => 'دانشگاه',
            'field' => 'مقطع',
            'grade' => 'رشته',
            'from_id' => 'از',
            'to_id' => 'تا',
            'project_size_id' => 'اندازه پروژه',
            'project_type_id' => 'نوع پروژه',
            'category_type_id' => 'نوع دسته بندی',
            'company_size_id' => 'اندازه شرکت',
            'company_type_id' => 'نوع شرکت',
            'page_name' => 'ایمیل',
            'website' => 'ایمیل',
            'service_type_id' => 'ایمیل',
            'category_id' => 'دسته بندی',


        ]]

);
