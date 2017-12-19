# Solution

**Note:** I modified this example.  The original would not execute because
the XML in the sample was not well-formed.

Here we have what is known as an XML injection vulnerability.  At first, it
appears that submitted variables are filtered for XML special characters.
However, with an understanding of `strpos()` we can see that it is possible
for user-defined XML to slip through.

The condition...

```php
if (
    (!strpos($user, '<') || !strpos($user, '>')) &&
    (!strpos($pass, '<') || !strpos($pass, '>'))
) {
    // ...
}
```

does **not** filter out XML as expected.  Specifically, `strpos()` returns
the index of the "needle" in the "haystack."  The index could be 0, which is
effectively `false` in a boolean context.  Thus, if `<` is the first
character of a submitted value, it will be passed through just fine!

Try passing `</user><injected-tag>tag</injected-tag><user>` in the username
field to see that it is accepted as part of the XML parsed internally.

This could be especially dangerous if processing instructions are accepted.
However, the extent of the damage depends on what is done in the `doLogin()`
function.

To solve this issue, use the following conditional instead...

```php
if (
    (strpos($user, '<') === false || strpos($user, '>') === false) &&
    (strpos($pass, '<') === false || strpos($pass, '>') === false)
) {
    // ...
}
```

# References

* [CWE-91]( https://cwe.mitre.org/data/definitions/91.html)
* [strpos()](https://secure.php.net/manual/en/function.strpos.php)
* [SimpleXMLElement](https://secure.php.net/manual/en/class.simplexmlelement.php)
