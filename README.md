XPathDocument
=============

<img src="https://travis-ci.org/Wildhoney/Banter.js.png?branch=master" />

Getting Started
-------------

XPathDocument allows you to chain your `query` methods, allowing you to delve deeper into the DOM hierarchy with each iteration.

```php
$posts = $xpathDocument->query('//div[@class="posts"]');

foreach ($posts as $post) {
    $comments = $post->query('div[@class="comments"]');
}
```

Each `query` will return an instance of `XPathDocument_Dom_List` &ndash; and this class implements `Iterator`, `ArrayAccess` and `Countable`, which gives you lots of useful methods for manipulating the node collection.

Typically `XPathDocument_Dom_List` will hold a collection of `XPathDocument_Dom_Element` instances &ndash; but other instances are possible:

* `XPathDocument_Dom_Element` &ndash; generic elements with values and attributes;
* `XPathDocument_Dom_Attr` &ndash; specific for node attributes;
* `XPathDocument_Dom_Text` &ndash; specific for text values of nodes;

The latter two have a simple `getText` method for returning their values. However, `XPathDocument_Dom_Element` has the greatest flexibility.

Element Instance
-------------

With an instance of `XPathDocument_Dom_Element` you have the following methods:

* `getText` &ndash; retrieve the value of the node;
* `getHtml` &ndash; retrieve the HTML value of the node;
* `getName` &ndash; retrieve the name of the node (`span`, `div`, etc...);
* `getAttribute` &ndash; retrieve an attribute by its name;
* `query` &ndash; use node as the context for further querying;

Reddit Example
-------------

Please see the Reddit.com example in the `example/index.php` which will demonstrate how simple it is to crawl websites with `XPathDocument`!