import algolia from 'algoliasearch'
import autocomplete from 'autocomplete.js'

let index = algolia('N5V61GMLWD', '077a976b0418d57cd84ed43453cf6829');

export const userautocomplete = selector => {
 let users = index.initIndex('users');

  return autocomplete(selector, {}, {
      source : autocomplete.sources.hits(users, { hitsPerPage:10, }),
      displayKey : 'name',
      templates : {
          suggestion(suggestion) {
              if(suggestion.id !== Laravel.user.id) {
                  return '<img src=" '+ suggestion.avatar + '">' + " &nbsp; " + '<span>' + suggestion.name + '</span>';
              }else {
                  return null;
              }
          },
       empty : '<div class="aa-empty"> No people found </div>'
      }
  })

};