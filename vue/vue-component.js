
Vue.component('button-counter', {
  data: function () {
    return {
      count: 0
    }
  },
  template: '<button v-on:click="count++">You clicked me {{ count }} times.</button>'
});

Vue.component('blog-post', {
  props: ['post'],
  template: `
    <div>
      <p>{{ post.title }}</p>
      <button class="btn btn-primary" v-on:click="$emit('enlarge-text')">Enlarge text</button>
      <button class="btn btn-danger" v-on:click="$emit('narrow-text')">Narrow text</button>
    </div>
  `
});

Vue.component('tab-home', { 
  template: '<div>Home component</div>' 
});

Vue.component('tab-posts', { 
  template: '<div>Posts component</div>' 
});

Vue.component('tab-archive', { 
  template: '<div>Archive component</div>' 
});

Vue.component('test-data-transfer', { 
  props: ['date'],
  template: '<div>Today：{{date}}</div>' 
});

Vue.component('counter', { 
  props: ['title','plusBtnName','minusBtnName'],
  data: function(){
    return{
      count: 0
    }
  },
  template: `
    <div>
      <button @click="count++">{{plusBtnName}}</button>
      <button @click="count--">{{minusBtnName}}</button>
      Count: {{count}}
    </div>
  `
});

new Vue({
  el: '#div',
  data: {
    posts: [
      { id: 1, title: 'My journey with Vue' },
      { id: 2, title: 'Blogging with Vue' },
      { id: 3, title: 'Why Vue is so fun' }
    ],
    postFontSize: 2,
    currentTab: 'Home',
    tabs: ['Home', 'Posts', 'Archive'],
    date: '2019-12-27',
    counters: [{        
      title: 'Counter',
      plusBtnName: '+',
      minusBtnName: '-'
    }, {
      title: 'Counter',
      plusBtnName: 'Plus',
      minusBtnName: 'Minus'
    }, {
      title: '計數器',
      plusBtnName: '加',
      minusBtnName: '減'
    }]
  },
  computed: {
    currentTabComponent: function () {
      return 'tab-' + this.currentTab.toLowerCase()
    }
  }
});