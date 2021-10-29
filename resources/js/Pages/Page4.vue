<template>
  <div class="row">
    <div class="col-6">
      <div class="btn-group list-group-item">
          <button class="btn btn-secondary" @click="add">Add</button>
          <button class="btn btn-secondary" @click="replace">Replace</button>
      </div>
      <draggable
          id="first"
          :list="list"
          draggable=".item"
          group="a" 
          class="p-3.5 grid auto-rows-max grid-cols-4 gap-y-2 gap-x-2 bg-gray-200 w-full h-screen"
          :move="onClickMove"
          ghost-class="grabbing"
          chosen-class="grab"
          drag-class="grabbing"
          force-fallback=true
      >

          <div 
              v-for="(element, index) in list" 
              :key="index" 
              class="list-group-item item p-0 rounded-t-lg rounded-b-lg" 
              :data-id="element.id"
              @click="send(element, 'left')"
          >
              <img :src="element.download_url" class="inline-block h-44 w-44 rounded-lg">
              <div>
                  <div>
                      <h3 class="text-sm text-gray-700 p-2">
                          ({{index}}) {{ element.author }}
                      </h3>
                  </div>
              </div>
          </div>

      </draggable>
    </div>

    <div class="col-6">
      <div class="btn-group list-group-item">
          <button class="btn btn-secondary" @click="add2">Add</button>
          <button class="btn btn-danger" @click.prevent="cancel2">Cancel</button>
          <button class="btn btn-success" @click.prevent="save">Save</button>
      </div>
      <draggable
          :list="list2"
          draggable=".item"
          group="a" 
          class="p-3.5 grid auto-rows-max grid-cols-4 gap-y-2 gap-x-2 bg-gray-200 w-full h-screen"
          :move="onClickMove"
          ghost-class="grabbing"
          chosen-class="grab"
          drag-class="grabbing"
          force-fallback=true
      >

          <div 
              v-for="(element, index) in list2" 
              :key="index" 
              class="list-group-item item p-0 rounded-t-lg rounded-b-lg" 
              :data-id="element.id"
              @click="send(element, 'right')"
          >
              <img :src="element.download_url" class="inline-block h-44 w-44 rounded-lg">
              <div>
                  <div>
                      <h3 class="text-sm text-gray-700 p-2">
                          ({{index}}) {{ element.author }}
                      </h3>
                  </div>
              </div>
          </div>

      </draggable>
    </div>
  </div>
</template>

<script>
import draggable from "vuedraggable";

let id = 1;
export default {
  components: {
    draggable
  },
  props: {
    title: '',
    resp: null,
  },
  mounted() {
    this.getData()
  },
  data() {
    return {
      list: [],
      list2: [],
    };
  },
  methods: {
    send: function(item, clickedSide){
      //console.log(clickedSide)
      if(clickedSide == 'left'){
        this.list2.push(item)
        this.list.splice(this.list.indexOf(item), 1)        
      } else {
        this.list.push(item)
        this.list2.splice(this.list2.indexOf(item), 1)
      }
    },
    save: function(){
      axios
        .post(route('page4.send'), this.list2)
        .then((response) => {
          console.log(response.data.data)
        })
    },
    add: function() {
      this.list.push({ name: "Juan " + id, id: id++ });
    },
    replace: function() {
      this.list = [{ name: "Edgard", id: id++ }];
    },
    add2: function() {
      this.list2.push({ name: "Juan " + id, id: id++ });
    },
    cancel2: function() {
      this.list2.forEach(item => {
        this.list.push(item)
      });
      this.list2 = [];
    },
    getData: function(){
      axios.get('https://picsum.photos/v2/list?limit=8')
        .then((response) => {
          this.list = response.data
        })
    },
    onClickMove: function(e){
      // if(e.to == e.from)
      //   console.log(e.to)
      // else
      //   console.log(e.to)
    },
  }
};

</script>
<style scoped>
.item{
  background-color: transparent;
  border-radius: 0.5rem;
}
.item:active{
    filter: drop-shadow(0 0 0.15rem rgb(102, 102, 102));
    transition: filter 0s;
}
.item:active > img{
    filter: drop-shadow(0 0 0.10rem rgb(221, 221, 221)) opacity(60%) blur(1px);
    cursor: grabbing;
    transition: filter 0s;
}
.item:hover:active{
    cursor: grabbing;
} 

.grabbing {
  cursor: grabbing !important;
}
.grab {
  cursor: grab;
}
.list-group-item {
  cursor: grab;
}
</style>