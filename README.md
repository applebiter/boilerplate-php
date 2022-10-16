# Boilerplate-PHP

It's a CakePHP 4 skeleton application with a custom authentication and 
authorization scheme using a relational database backend. It is designed
to be interoperable with a boilerplate Qt (C++) desktop application, which
is another of my repos, applebiter/boilerplate-qt.

## Standards and Convention

CakePHP asks that developers adhere to convention. The more the developer
adheres to the CakePHP way of doing things, the more utility CakePHP can
deliver. Well, it's really only useful up to a point, anyway. What we want
is secure code that does all of the generic, boring stuff so that when we
code we may focus on the interesting, domain-specific programming that our
particular project needs. I think my authentication and authorization
solutions are more powerful and flexible than the native CakePHP solutions,
and it's naive to imagine that we won't need user management and file
management built in, as well.

## Evolving, Never Finished

At this time, it's really not finished at all, but it soon will be at a place
where the code is all useful and coherent. I don't write tests. Oh, everything
is tested, but I don't write tests to prove to others I have tested it. If
that's a problem, it's all good. You can either move along or write the tests.
It is open source, after all. At some arbitrary point I will consider it to be
a v1.0 release and probably only ever return to it if I absolutely have to.

## Features

* Optional user self-registration process
* Bootstrap and jQuery with a selection of CSS themes provided by [Bootswatch] (https://bootswatch.com/). Users may select their own, preferred CSS theme 
and timezone bias.
* Users may register SMS-capable devices for notifications and/or 2-factor 
authentication. Sensitive device data is stored in encrypted format.
* Uses libsodium for enterprise-grade cryptographic needs, such as password-
hashing, symmetric and asymmetric encryption, and encryption of files.
* Real-time chat using event stream

## Qt Interoperability

So, the programming iceberg is what it is, and it really doesn't matter which 
particular language or stack you came from, in the end you need a web
application AND a custom desktop application that are securely interoperable
to deliver any enterprise-grade product. Doing all of that is pretty easy if 
you are a professional and have a mentor. In that case, you've probably also
signed a legally-binding non-disclosure and/or a non-compete waiver. 

If you are a self-taught programmer like me, you can waste a lot of time and 
experience a lot of unnecessary discuragement just figuring all of this out.
And let's just keep it real. If you can develop a product that builds a userbase of a thousand people or more, you will have a desirable product to sell, and if a large corporation buys your product and user base they are going to retool it
all using in-house tech, anyway. Ba-DUM-tish. That's how it really works, 
apparently. So your mission is to be first, and to do it with a minimum of 
legal exposure. Hence my use of first-class encryption and a standards-
embracing framework like CakePHP. 