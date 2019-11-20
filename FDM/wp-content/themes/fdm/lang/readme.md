Translatable strings are defined in the theme using the __() function, for example:

```
  <label><input type="checkbox" /> <?= __( 'Centres', 'fdm' ) ?></label>

```

This will look up the text 'Centres' in the appropriate fdm language file and output a translated version if there is one in the file, and if not it will output 'Centres' unchanged.  Note the second argument must be 'fdm' in order for it to use the language files defined in this directory.

To add translations, you have to edit the .po file for the language.  A translation looks like this:

```
msgid "Centres"
msgstr "Centers"

```

The .po file is for humans to edit. Before the changes will take effect you need to 'compile' the .po file into a .mo file, which is designed for machines to use and optimised for fast lookups.  Wordpress uses the .mo file.

To compile po files into mo files, use the command line utility 'msgfmt' as follows:

`msgfmt path/to/pofile.po -o path/to/mofile.mo`

For example, after changing to this lang directory, you can update the en_US translation with `msgfmt en_US.po -o en_US.mo`

