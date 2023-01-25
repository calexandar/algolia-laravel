<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel+AlgoliaSearch</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/algoliasearch@4.14.3/dist/algoliasearch-lite.umd.js" integrity="sha256-dyJcbGuYfdzNfifkHxYVd/rzeR6SLLcDFYEidcybldM=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@4.49.4/dist/instantsearch.production.min.js" integrity="sha256-Ps194FVLiZAj7tXnC/xW7piaYV5EaKB8NWYu1xAN3Rc=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.css@8.0.0/themes/satellite-min.css" integrity="sha256-p/rGN4RGy6EDumyxF9t7LKxWGg6/MZfGhJM/asKkqvA=" crossorigin="anonymous">



    </head>
    <body>

       <div id="searchbox" style="padding: 8px"></div>
       <div id="range-slider" style="padding: 8px"></div>

        <div id="hits"></div>
        <div id="pagination"></div>

        <script type="text/javascript">

    
                const searchClient = algoliasearch(
                    '{{ config("scout.algolia.id") }}', 
                    '{{ Algolia\ScoutExtended\Facades\Algolia::searchKey(App\Models\Product::class) }}'
                    );

                    const search = instantsearch({
                    indexName: 'products',
                    searchClient,
                    });

                    search.addWidgets([
                    instantsearch.widgets.searchBox({
                        container: '#searchbox',
                    }),
                    instantsearch.widgets.rangeSlider({
                        container: '#range-slider',
                        attribute: 'price',

                        min:0,
                        max:300
                    }),
                    instantsearch.widgets.configure({
                    hitsPerPage: 4,
                    }),
                    instantsearch.widgets.pagination({
                    container: '#pagination',
                    }),




                    instantsearch.widgets.hits({
                        container: '#hits',
                        templates: {
                        item(hit, { html, components }) {
                        return html`
                            <h2>
                            ${components.Highlight({ attribute: 'title', hit })}
                            </h2>
                            <p>${hit.description}</p>
                            <p>${hit.price}</p>
                        `;
                        },
                    },
                    })
                ]);

                search.start();
    
        </script>
    </body>

  
</html>
