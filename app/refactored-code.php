<?php
class Feature {

    public function __invoke(array $input): void
    {
        $masterEmail = $input['masterEmail'] ?? null;
        $email = $input['email'] ?? null;

        if (!$masterEmail && !$email) {
            $masterEmail = 'unknown';
        }

        echo 'The master email is ' . $masterEmail . '\n';
        echo "\n";

    }
}

(new Feature())($_REQUEST);