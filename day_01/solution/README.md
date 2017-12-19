# Solution

This application contains an unrestricted file upload vulnerability.  The
call to `in_array()` in the `Challenge` object's destructor behaves in
a type-unsafe way because its third parameter is set to false by default.

Thus, the whitelist can be bypassed by uploading a file such as
`1exploit.php`.  This special file name is cast to the integer '1' by the
`in_array()` function and then compares equal to the '1' in the `$whitelist`
array.

Once the malicious file `1exploit.php` has been uploaded, it is then
accessible at the URL below:

    http://localhost:8000/upload_dir/1exploit.php

The result is that the hacker can see *everything* about the server.

# References

* [CWE-434](https://cwe.mitre.org/data/definitions/434.html)
* [in_array()](https://secure.php.net/manual/en/function.in-array.php)
* [PHP comparison operators](https://secure.php.net/manual/en/language.operators.comparison.php)
