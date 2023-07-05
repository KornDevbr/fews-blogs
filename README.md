# Website creation plan

## Overview

This is the [@korn](mailto:y.korniievskyi@dev-branch.com) website for studying and practice with the **PHP**, HTML, CSS and JS programming languages. 

## Website must include
1. Homepage(index.php) with articles inside it.
2. Logged in homepage with articles inside it.
3. Own articles page with an opportunity to add/edit/delete content (articles).
4. About US page.
5. ...

### Optional
1. Tags for articles and possibility to sort articles by topics. Or pages with different topics.
2. Articles must include possibility to add images.
    - Use the same script for saving user avatars. (Optional)
3. Login form on home page. Or maybe not.
4. Not removing data from fields while registration.
5. Comments system.
6. Like (rating) articles system.
7. Add buttons to publish/unpublished articles.
8. ...

## Order of doing things. Backend. (Project Status)
1. ~~Make a sample of the `index.php` page.~~ :white_check_mark:
2. ~~Create a **database connection** page.~~ :white_check_mark:
3. ~~Create `register.php` page.~~
    - ~~Add a form with choosing: male, female, cat, other~~ :white_check_mark:
4. ~~Create `login.php` page.~~ :white_check_mark:
5. ~~Create `logout.php` page.~~ :white_check_mark:
6. ~~Create `add_content.php` page.~~ :white_check_mark:
7. ~~Create a list of user's articles on `dashboard.php` page.~~ :white_check_mark:
8. ~~Create `article.php` page.~~ :white_check_mark:
9. ~~Create `article_edit.php` page.~~ :white_check_mark:
10. ~~Create `article_preview.php` page.~~ :white_check_mark:
11. ~~Create `article_delete.php` page.~~ :white_check_mark:
12. ~~Create `about_us.php` page.~~
13. Create `home.php` page. *For what???*
14. ~~Cerate `user_profile.php` page.~~ :white_check_mark:
    - ~~Add `Edit` link to profile page. That appears only for the page owner.~~ :white_check_mark:
15. ~~Create `user_profile_edit.php` page.~~
    - ~~Create different forms for every change like email, gender, bio, password;~~
    - ~~Create a function with database query that contains variables for updated item and its updated value;~~ :white_check_mark:
16. Make a code look good. Leave *comments* above the code block with explanations of them.
17. ~~Change `include("article_not_found.php")` and the same with "user_not_exist.php" to one `PAGE NOT FOUND` file.~~ :white_check_mark:
18. ...

## Content creation pages must include:
1. Add Article feature.
2. Edit Article feature.
3. Delete Article feature.
4. List of user made Articles.
5. Textarea field.
6. Publish checkbox.
7. Tags system (experiment with database queries).
8. ...

## Comment system making plan.
1. ~~Create a database table for storing users comments. The table must include the next rows:~~
    - comment_id;
    - comment;
    - publication_datetime;
    - edited_datetime;
    - article_id;
    - article_topic;
    - username;
    - username_id;
    - username_email.   :white_check_mark:
2. ~~Create the `comment_add.php` page: ~~
    - Form for adding a comment;
    - Database query with adding a comment; :white_check_mark: (Made it on the `article.php` page.)
3. ~~Create the `comment_edit.php` page:~~
    - Form for editing a comment;
    - Database query for editing comments;
4. ~~Create the `comment_delete.php` page.~~
5. ~~Add list of users comments to the `article.php` page.~~
    - Edit comment button:
        ```
        if($_SESSION['username']) == $comment_query['username']{
            EDIT_BUTTON
        }
        ```
6. ~~Add comments quantity under the every article on the `index.php` page.~~
7. ~~Add list of all left user's comments to the `dashboard.php` page.~~
8. Comment list section in descending order. Comment must include:
    - Linked username;
    - Publication date;
    - Comment text;
    - Edit comment button (For comment owner);
    - Delete comment button (For comment owner);
    - Comment number; 