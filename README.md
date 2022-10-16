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
where the code is all useful and coherent. At some arbitrary point I will consider it to be a v1.0 release and probably only ever return to it if I absolutely have to.

## Features

* Optional user self-registration process
* Bootstrap and jQuery with a selection of CSS themes provided by [Bootswatch] (https://bootswatch.com/). Users may select their own, preferred CSS theme 
and timezone bias.
* Users may register SMS-capable devices for notifications and/or 2-factor 
authentication. Sensitive device data is stored in encrypted format.
* Uses libsodium for enterprise-grade cryptographic needs, such as password-
hashing, symmetric and asymmetric encryption, and encryption of files.
* Real-time chat using event stream
* Role-based permission sets for all endpoints, entities, and tables. The roles and resources are all stored in the db and so are customizable and extensible for your own code.
