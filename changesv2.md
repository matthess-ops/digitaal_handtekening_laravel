-alot of the changes needed in the front end should also be applied here
see aanpassingen  v2.md


-Next time think about controller names that better reflect their function. 

-For changing the status (open, not_agreed, signed) of signed documents dont
use a string you should use an index. And then in the controller function match this with the correct string. Or even better do this in the front end, because as explained in the front end aanpassingen.md. The currently used status names are a bit confusing. 

-For api development use try catch getMessage() functions for everything because else you wont be able to see the laravel exception message. This makes debuging incredible hard. 

- work more with resources because not data needs to be returned to the front end only return data is needed.

- put all the api controllers in an api folder under the controllers folder

