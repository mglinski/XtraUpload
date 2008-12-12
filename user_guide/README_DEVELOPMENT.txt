I know exactly how I want the docs written, and I will try to explain to anyone who wants to help we write them below.

There are 3 main topics, installing XF, the main pages and what they do, and the actual code docs for help with extending. Each topic has its own folder. There will eventually be a changelog, table of contents, and license file in the main folder.

The install docs are just that, a walkthrough with screenshots of the install process. There is to be at least one screen shot of each step, with annotations linked to elements in the actual page describing what each point is(IE: a link on the SEO option links to a paragraph explaining what that option does). This will extend to the upgrader once it is written.

The Pages topic is for all pages that are displayed in XF: all the admin pages, and all the regular user pages. These files are to have seperations for each sub-page(IE: files/get ) describing in detail what each page does and what to expect if something goes wrong. This is also true for the admin section.

The code docs will list each function in each library, model, and helper file created for XF. These files are to include a general discussion of what the file is supposed to do or help, and an API refrence for every function contained there in. For any preexisting files the docs will be pulled and updated as needed from the code igniter docs. These are mainly for people already familiar with PHP so the level of technical speak is reccomended to be moderate.