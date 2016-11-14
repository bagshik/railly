<template>
  <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
          <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#railly-navbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="/"><img src="/img/railly.png">Rail.ly</a>
          </div>
          <div class="collapse navbar-collapse" id="railly-navbar">
              <ul class="nav navbar-nav navbar-right">
                <router-link tag="li" to="/" exact>
                  <a>Home</a>
                </router-link>
                <router-link tag="li" to="stations" exact>
                  <a>Stations</a>
                </router-link>
                <router-link tag="li" to="about" exact>
                  <a>About</a>
                </router-link>
              </ul>
          </div>
      </div>
  </nav>
</template>

<script>
export default {}
</script>
