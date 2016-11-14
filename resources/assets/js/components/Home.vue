<template>
<div>
  <div class="background-image"></div>
  <div class="jumbotron">
      <div class="container">
          <div class="row">
              <div class="col-md-8 col-md-offset-2">
                  <h1>Plan your journey...</h1>
                  <form>
                      <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label class="sr-only" for="depart">Depart</label>
                                  <div class="input-group">
                                  <div class="input-group-addon">From</div>
                                  <input type="text" class="form-control" id="fromStation" placeholder="Brussels">
                                  </div>
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label class="sr-only" for="arrival">Arrival</label>
                                  <div class="input-group">
                                  <div class="input-group-addon">To</div>
                                  <input type="text" class="form-control" id="toStation" placeholder="Antwerp">
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <select class="form-control">
                                      <option>I will be leaving on...</option>
                                      <option>I will be arriving on...</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <div class="input-group date" id="datetimepicker1">
                                      <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                      </span>
                                      <input type="text" class="form-control" placeholder="Click on the icon">
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12">
                              <button type="submit" class="btn btn-primary btn-lg btn-block" v-on:click.prevent="checkTrains">Check for availables trains</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
</template>

<script>
import moment from 'moment';
import datetimepicker from '../../bower/datetimepicker/build/js/bootstrap-datetimepicker.min.js';

export default {
  mounted() {
    $('#datetimepicker1').datetimepicker({
      defaultDate: moment(),
      format: "dddd, MMMM Do YYYY, HH:mm",
      showClose: true
    });
  },
  methods: {
    checkTrains() {
      this.$http.get('https://api.irail.be/stations/', {
        withCredentials: true
      }).then((response) => {
        console.log('response', JSON.stringify(response));
      }, (response) => {
        console.error(':(');
      });
    }
  }
}
</script>
