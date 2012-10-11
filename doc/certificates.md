Struggle for survival with Apple Certificates
=============================================

Ok, let's make it as easy as possible. You just need to know that the final .pkpass file (the Passkit) is a signed zip file. All process (file compilation, hashing, signing and zip package creation) is simplified for you by PHPassKit, but the certificate is something only you can generate.

If you have already create a certificate to develop or distribute iOS/OSX applications, these steps will be familiar:

1. Open a web browser, sign in [Apple Developer Member Center][admc]
2. Go to the [iOS Provisioning Portal][iospv]
3. Click on `Pass Type IDs` (left menu)
4. Click on `New Pass Type ID` button
5. Follow the steps
6. Download the Pass Certificate file (it should be a .cer file) and open it with Keychain Access
7. Open Keychain Access, select `My Certificates` on the left
8. Search your Pass Type ID, right click and select `Export "Pass Type ID: ..."`

This file you have just download is your certificate, a .p12 file

[admc]: https://developer.apple.com/membercenter
[iospv]: https://developer.apple.com/ios/manage/overview/index.action