<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;

class TextFormat implements ProfileFormatter
{
    private $response;

    public function setData($profile)
    {
        $output = "Full Name: " . $profile->getFullName() . PHP_EOL;
        $output .= "Email: " . $profile->getContactDetails()['email'] . PHP_EOL;
        $output .= "Phone: " . $profile->getContactDetails()['phone_number'] . PHP_EOL;
        $output .= "Address: " . implode(", ", $profile->getContactDetails()['address']) . PHP_EOL;
        $output .= "Education: " . $profile->getEducation()['degree'] . " at " . $profile->getEducation()['university'] . PHP_EOL;
        $output .= "Skills: " . implode(", ", $profile->getSkills()) . PHP_EOL;

        // Add experience
        $output .= "\nExperience:\n";
        foreach ($profile->getExperience() as $job) {
            $output .= "- " . $job['job_title'] . " at " . $job['company'] . " (" . $job['start_date'] . " to " . $job['end_date'] . ")\n";
            $output .= "  Description: " . $job['description'] . PHP_EOL;
        }

        // Add certifications
        $output .= "\nCertifications:\n";
        foreach ($profile->getCertifications() as $cert) {
            $output .= "- " . $cert['name'] . " (Earned on: " . $cert['date_earned'] . ")\n";
        }

        // Add extracurricular activities
        $output .= "\nExtracurricular Activities:\n";
        foreach ($profile->getExtracurricularActivities() as $activity) {
            $output .= "- " . $activity['role'] . " at " . $activity['organization'] . " (" . $activity['start_date'] . " to " . $activity['end_date'] . ")\n";
            $output .= "  Description: " . $activity['description'] . PHP_EOL;
        }

        // Add languages
        $output .= "\nLanguages:\n";
        foreach ($profile->getLanguages() as $lang) {
            $output .= "- " . $lang['language'] . " (" . $lang['proficiency'] . ")\n";
        }

        // Add references
        $output .= "\nReferences:\n";
        foreach ($profile->getReferences() as $ref) {
            $output .= "- " . $ref['name'] . ", " . $ref['position'] . " at " . $ref['company'] . "\n";
            $output .= "  Contact: " . $ref['email'] . ", " . $ref['phone_number'] . PHP_EOL;
        }

        $this->response = $output;
    }

    public function render()
    {
        header('Content-Type: text');
        return $this->response;
    }
}
