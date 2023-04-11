# Few notes about solution
1. Refactored code is in `app/refactored-code.php`

2. I've found that legacy code is not compatible with PHP8+, so the solution uses two PHP containers: `web_legacy` with PHP7.4 (exposed on port 8080) and `web` with PHP8.2 (exposed on port 8081) - to verify if the refactored code is compatible with the latest PHP version.

3. `app/tests/tests.php` contains a test suite to verify the stability of the refactored code. In order to run the tests, you need to execute the following command:

```bash
$ php tests/legacy-test-suite.php
$ php tests/refactored-test-suite.php
``` 
Alternatively, you can navigate to http://localhost:8081/tests/legacy-test-suite.php and http://localhost:8081/tests/refactored-test-suite.php to test the solution. Replace 8081 with 8080 to switch between PHP8.2 and 7.4.


4. A database container is required to run the legacy code, but it is not used by the refactored code   