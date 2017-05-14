import algolia from 'algoliasearch'
import autocomplete from 'autocomplete.js'

let index = algolia('N5V61GMLWD', '077a976b0418d57cd84ed43453cf6829');

export const userautocomplete = selector => {
  index = index.initIndex('users');

  return autocomplete(selector, {}, {
      source : autocomplete.sources.hits(index, { hitsPerPage:10, }),
      displayKey : 'name',
      templates : {
          suggestion(suggestion) {
              return '<span>' + suggestion.name + '</span>'
          },
       empty : '<div class="aa-empty"> No people found </div>'
      }
  })

};