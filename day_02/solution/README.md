# Solution

**Defninition:** Cross-site Scripting (XSS) is an attack that enables
hackers to inject client-side scripts into web pages viewed by other users.

This app contains a reflected cross-site scripting vulnerability.  By
passing a special URL as the value of the "nextSlide" query string
parameter, an attacker can embed arbitrary JavaScript code within the page.

The attacker could then proceed to deceive unsuspecting users into clicking
a URL that embeds the same JavaScript code in their view of the page, thus
executing the malicious code in *their own browser*.

A simple example URL query string would be:

    ?nextSlide=javascript://comment%250aalert(1)

The URL in the parameter *is* a URL, and so it passes through `filter_var()`
with no problems!

# References

* [CWE-79](https://cwe.mitre.org/data/definitions/79.html)
