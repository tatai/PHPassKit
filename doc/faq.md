FAQ
===

How to install PHPassKit in symfony
-----------------------------------

Read [this doc](symfony.md)

How can I get a certificate to sign passkits?
---------------------------------------------

Read [this doc](certificates.md)

Can I use another Apple Worldwide Developer Relations certificate?
------------------------------------------------------------------

Yes. PHPassKit uses an Apple WWDR certificate in .pem format that is storaged in the `data` folder but you can use any other certificate intead this.

To do so, take a look to method `setAppleWWDR()` of `PHPassKit\Generator\Signature`. Use it to pass it the path to the new Apple WWDR certificate (remember to use .pem format).

What is my passTypeIdentifier and my teamIdentifier?
----------------------------------------------------

Read [this doc](apple-identifiers.md)
