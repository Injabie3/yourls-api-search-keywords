# yourls-api-search-keywords

This YOURLS plugin adds a new command to the YOURLS API: `action=search_keywords`

For a given keyword, it searches all keywords in the database and returns keywords
that are similar to the given string. The API call requires a `kw` parameter,
and uses the `LIKE %kw%` SQL expression to filter entries.

## Example
Assume your database contains the following keywords (the URL is irrelevant):
| keyword |
| - |
| myanimelist |
| myfavouriteanime |
| myfigurecollection |
| seasonalanime |
| jlptwordlist |

The following API calls will respond with the corresponding `keywords` field values:
* `action=keyword_search&substr=anime` =>
  `["myanimelist", "myfavouriteanime", "seasonalanime"]`
* `action=keyword_search&substr=my` =>
  `["myanimelist", "myfavouriteanime", "myfigurecollection"]`
* `action=keyword_search&substr=list` => `["myanimelist", "jlptwordlist"]`
* `action=keyword_search&substr=manga` => `[]`

## How to install this plugin
1. Create a new directory under the "user/plugins" directory
2. Save the "plugin.php" file into the directory you created in step 1
3. Activate the plugin using your YOURLS admin panel

## Credits
This repo is forked from:
- https://github.com/timcrockford/yourls-api-edit-url
- https://github.com/bryzgaloff/yourls-api-lookup-keywords-by-url-substr

It is a separate repo because I already have yourls-api-edit-url forked elsewhere.
