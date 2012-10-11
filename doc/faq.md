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

To do so, just pass to your Signature instance the path to your Apple WWDR certificate using `setAppleWWDR()`.

What is my passTypeIdentifier and my teamIdentifier?
----------------------------------------------------

Read [this doc](apple-identifiers.md)
