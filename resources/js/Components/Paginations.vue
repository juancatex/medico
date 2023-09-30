<script setup> 
import { Link } from '@inertiajs/vue3'; 
const props = defineProps({
    links: {
        type: Array 
    } 
}); 
function ver(object){
    if(object.includes('Next')){
        object=">>";
    }
    if(object.includes('Previous')){
        object="<<";
    }
    return object;
}
</script>

<template>
    
     

      <nav>
          <ul class="pagination">
            <template v-for="(link, k) in links" :key="k">
              <li v-if="link.url === null"  :class="link.active?'page-item active':'page-item'">  
                  <a class="page-link" v-html="ver(link.label)" ></a>
              </li>
              
              <li v-else  :class="link.active?'page-item active':'page-item'"> 
                  <Link   :href="link.url"  class="page-link">{{ ver(link.label)}}</Link>
              </li>
             </template>  
          </ul>
      </nav>
    
  </template>
