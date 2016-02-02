Anyone who wants to add form field to this repository is very welcome to do so.

Each form field will go in its own folder.  

This will allow svn users to include svn users to include a single folder
as an svn external.  Git users may be able to do something similar

Obviously you can also copy single form fields for use in your own modules.

It is recommended that you include any form fields in the following location:

mysite/thirdparty/formfields/{name of the form field folder}/

And all requirements should point to this location (see RatingField.php for an example)
