<template>
  <header>
      <nav>
          <ul>
              <li>
                  <router-link :to="{name: 'home'}"> Home </router-link>
              </li>
              <li>
                  <router-link :to="{name: 'posts'}"> Posts </router-link>
              </li>
              <li>
                  <router-link :to="{name: 'about'}"> Chi siamo </router-link>
              </li>
              <li>
                  <router-link :to="{name: 'contacts'}"> contatti </router-link>
              </li>
          </ul>
      </nav>
  </header>
</template>

<script>
export default {
    name: 'Header'
}
</script>

<style lang="scss" scoped>

header{
    background-color: blue;
    text-align: center;
    padding: 25px;
    ul{
        list-style: none;
        li{
            display: inline-block;
            margin: 0px 15px;
            a{
                color: white;
                text-decoration: none;
                &:hover{
                    color: greenyellow;
                }
                &:active{
                    color: yellow;
                }
            }
        }
    }
}

</style>