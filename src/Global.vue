<template>
  <div class="wrap">
      <div class="ninja_popup_main_nav">
          <span>{{ 'Ninja Popups' }}</span>
          <router-link v-for="menuItem in topMenus" :key="menuItem.route" 
          exact
          :to="{ name: menuItem.route }">
              {{ menuItem.title }}
          </router-link>
      </div>
      <div class="ninja_popup_content">
          <router-view></router-view>
      </div>
  </div>
</template>

<script>
    export default {
        name: 'global_wrapper',
        data() {
            return {
                topMenus: []
            }
        },

        methods: {
            setTopmenu() {
                this.topMenus = [
                    {
                        route: 'all-popups',
                        title: 'All Popups'
                    },
                    {
                        route: 'support',
                        title: 'Support'
                    },
                ]
            }
        },

        mounted() {
            this.setTopmenu();
        }
    }
</script>
