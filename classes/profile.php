<?php
/**
 * DevfolioX functions and definitions
 *
 *
 * @package DevfolioX
 */

class Profile {

    public static function getPersonalDetails() {
        $menuImage = get_field('profile_image_menu', 'option');
        $bannermage = get_field('profile_image_banner', 'option');
        $firstName = get_field('first_name', 'option');
        $middleName = get_field('middle_name', 'option');
        $lastName = get_field('last_name', 'option');
        return [
            'menuImage' => $menuImage,
            'bannermage' => $bannermage,
            'firstName' => $firstName,
            'middleName' => $middleName,
            'lastName' => $lastName
        ];
    }

    public static function getConatctInfo() {
        $email = get_field('email', 'option');
        $phone = get_field('phone', 'option');
        $address = get_field('address', 'option');
        return [
            'email' => $email,
            'phone' => $phone,
            'address' => $address
        ];
    }

    public static function getSocialMedia() {
        $linkedin = get_field('linkedin', 'option');
        $github = get_field('github', 'option');
        $twitter = get_field('twitter', 'option');
        $facebook = get_field('facebook', 'option');
        $instagram = get_field('instagram', 'option');
        return [
            'linkedin' => $linkedin,
            'github' => $github,
            'twitter' => $twitter,
            'facebook' => $facebook,
            'instagram' => $instagram
        ];
    }


}
