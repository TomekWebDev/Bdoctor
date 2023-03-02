<template>
  <div>
    <div class="mt-1 pt-1 pb-1 footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-5 col-xs-12 about-company">
            <h2>BoolDoctor</h2>
            <p class="text-white-50">
              Sito in cui puoi cercare il medico più adatto a te!
            </p>
          </div>
          <div class="col-lg-3 col-xs-12">
            <h4 class="mt-lg-0 mt-sm-3">Autori</h4>
            <ul class="m-0 p-0 links">
              <li>- Tommaso Mangiagalli</li>
              <li>- Carmine Mele</li>
              <li>- Marco Perta</li>
              <li>- Elsti Shehati</li>
            </ul>
          </div>
          <div class="col-lg-4 col-xs-12 location">
            <h4 class="mt-lg-0 mt-sm-4">Contatti</h4>
            <p class="mb-0">(541) 754-3010</p>
            <p><i class="fa fa-envelope-o mr-3"></i>info@hsdf.com</p>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col copyright">
            <p class="">
              <small class="text-white-50">© 2019. All Rights Reserved.</small>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "FooterComp",
};
</script>

<style lang="scss" scoped>
* {
  cursor: pointer;
}
.footer {
  background: #076dbb;
  color: white;
}
.links {
  list-style-type: none;
}

.links li {
  color: white;
  transition: color 0.2s;
}
.links li:hover {
  text-decoration: none;
  color: #4180cb;
}
.about-company a {
  color: white;
  transition: color 0.2s;
}
.location i {
  font-size: 18px;
}

.copyright p {
  border-top: 1px solid rgba(255, 255, 255, 0.1);
}
</style>
