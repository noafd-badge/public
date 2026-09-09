# public
Public website, badge releases, documentation and transparency records for NoAfD Badge.

## Content HOWTO

### Managing content

Editorial content lives in `content/`.

Use Markdown (`.md`) by default. If a file with the same path exists as `.html`, the HTML file overrides the Markdown file.

Example:

```text
content/infos/transparenz.md
content/infos/transparenz.html   # overrides the Markdown file
````

Pages and navigation are defined in `content/navigation.yaml`. The order in the YAML file is also the order in the navigation.

A page entry can point to content anywhere below `content/`:

```yaml
- id: transparenz
  title: Transparency
  page: transparenz
  content: infos/transparenz
```

This creates `/transparenz/` and loads `content/infos/transparenz.md` or the HTML override.

### YAML fields

* `id` — internal identifier.
* `title` — visible navigation title; also used as page title by default.
* `href` — direct URL, e.g. `/`.
* `anchor` — homepage anchor, e.g. `badges` becomes `/#badges`.
* `page` — creates a static page and defines its URL slug.
* `content` — content path relative to `content/`, without extension.
* `page_title` — optional page title override.
* `children` — nested navigation items.

Example:

```yaml
main:
  - id: infos
    title: More information
    children:
      - id: manifest
        title: Manifest
        page: manifest
        content: infos/manifest
```

### Essential Markdown syntax

```md
# Heading 1
## Heading 2
### Heading 3

Regular paragraph text.

**Bold text**
*Italic text*

[Internal link](/manifest/)
[External link](https://example.com)

- List item
- Another item

1. First item
2. Second item

> Blockquote

`inline code`
```

For more complex markup, use an `.html` file instead of Markdown.
