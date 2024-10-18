<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;

class HTMLFormat implements ProfileFormatter
{
    private $response;

    public function setData($profile)
    {
        // Basic Information
        $output = "<h1>Profile of " . $profile->getFullName() . "</h1>";
        $output .= "<p><strong>Email:</strong> " . $profile->getContactDetails()['email'] . "</p>";
        $output .= "<p><strong>Phone:</strong> " . $profile->getContactDetails()['phone_number'] . "</p>";

        // Education
        $output .= "<h2>Education</h2>";
        $output .= "<p>" . $profile->getEducation()['degree'] . " at " . $profile->getEducation()['university'] . "</p>";

        // Skills
        $output .= "<h2>Skills</h2>";
        $output .= "<p>" . implode(", ", $profile->getSkills()) . "</p>";

        // Experience
        $output .= "<h2>Experience</h2><ul>";
        foreach ($profile->getExperience() as $job) {
            $output .= "<li><strong>" . $job['job_title'] . "</strong> at " . $job['company'] .
                " (" . $job['start_date'] . " to " . $job['end_date'] . ")<br>";
            $output .= "<em>" . $job['description'] . "</em></li>";
        }
        $output .= "</ul>";

        // Certifications
        $output .= "<h2>Certifications</h2><ul>";
        foreach ($profile->getCertifications() as $cert) {
            $output .= "<li><strong>" . $cert['name'] . "</strong> (Earned on: " . $cert['date_earned'] . ")</li>";
        }
        $output .= "</ul>";

        // Extracurricular Activities
        $output .= "<h2>Extracurricular Activities</h2><ul>";
        foreach ($profile->getExtracurricularActivities() as $activity) {
            $output .= "<li><strong>" . $activity['role'] . "</strong> at " . $activity['organization'] .
                " (" . $activity['start_date'] . " to " . $activity['end_date'] . ")<br>";
            $output .= "<em>" . $activity['description'] . "</em></li>";
        }
        $output .= "</ul>";

        // Languages
        $output .= "<h2>Languages</h2><ul>";
        foreach ($profile->getLanguages() as $lang) {
            $output .= "<li>" . $lang['language'] . " (" . $lang['proficiency'] . ")</li>";
        }
        $output .= "</ul>";

        // References
        $output .= "<h2>References</h2><ul>";
        foreach ($profile->getReferences() as $ref) {
            $output .= "<li><strong>" . $ref['name'] . "</strong>, " . $ref['position'] .
                " at " . $ref['company'] . "<br>";
            $output .= "Contact: " . $ref['email'] . ", " . $ref['phone_number'] . "</li>";
        }
        $output .= "</ul>";

        $this->response = $output;
    }

    public function render()
    {
        return $this->response;
    }
}
