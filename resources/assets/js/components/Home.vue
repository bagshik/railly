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
                                    <input type="text" class="form-control" id="fromStation" placeholder="Brussels" autocomplete="off">
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
                                    <select class="form-control" v-model="selection">
                                        <option v-for="option in options" v-bind:value="option.value">
                                            {{ option.text }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group date" id="datetime">
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
    <div class="container">
        <div class="row home-main">
            <div class="col-md-8 col-md-offset-2">
                <beat-loader :loading="spinner.loading" :size="spinner.size" :color="spinner.color"></beat-loader>
                <transition name="fade">
                    <div class="trains" v-show="trains">
                        <div class="panel panel-info" v-for="train in trains" :key="train.id">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    {{ formatUnixTime(train.departure.time) }} > {{ formatUnixTime(train.arrival.time) }}
                                    <div class="pull-right">{{ formatDuration(train.duration) }} minutes</div>
                                </h3>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Station</th>
                                        <th>Train</th>
                                        <th>Platform</th>
                                        <th>Delay</th> 
                                    </tr> 
                                </thead> 
                                <tbody> 
                                    <tr>
                                        <td>{{ formatUnixTime(train.departure.time) }}</td>
                                        <td>{{ train.departure.station }}</td>
                                        <td>{{ train.departure.vehicle }}</td>
                                        <td>{{ train.departure.platform }}</td>
                                        <td>{{ formatDuration(train.departure.delay) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ formatUnixTime(train.arrival.time) }}</td>
                                        <td>{{ train.arrival.station }}</td>
                                        <td>{{ train.arrival.vehicle }}</td>
                                        <td>{{ train.arrival.platform }}</td>
                                        <td>{{ formatDuration(train.arrival.delay) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import moment from 'moment';
import datetimepicker from '../../bower/datetimepicker/build/js/bootstrap-datetimepicker.min.js';
import typeahead from '../../bower/typeahead/bootstrap3-typeahead.min.js';
import BeatLoader from 'vue-spinner/src/BeatLoader.vue';

export default {
    mounted() {
        let self = this;

        self.$http.get('https://railly.herokuapp.com/data/stations.json', {
            withCredentials: true,
            headers: {
                Accept: 'application/json'
            }
        }).then((response) => {
            // JSON.parse(response.data);
            self.stations = response.data;

            $('#fromStation').typeahead({
                source: self.stations['@graph'],
                afterSelect: function(item) {
                    self.fromStation = item['@id'];
                }
            });

            $('#toStation').typeahead({
                source: self.stations['@graph'],
                afterSelect: function(item) {
                    self.toStation = item['@id'];
                }
            });

        }, (response) => {
            console.error(':(');
        });

        $('#datetime').datetimepicker({
            format: 'dddd, MMMM Do YYYY, HH:mm',
            defaultDate: moment(),
            showClose: true
        }).on('dp.change', function(e) {
            self.date = e.date.format('DDMMYY');
            self.time = e.date.format('HHmm');  
        });
    },
    data() {
        return {
            date: moment().format('DDMMYY'),
            time: moment().format('HHmm'),
            fromStation: '',
            toStation: '',
            stations: '',
            trains: '',
            selection: 'depart',
            spinner: {
                loading: false,
                size: '30px',
                color: '#bce8f1'
            },
            options: [
                { text: 'I will be leaving on...', value: 'depart' },
                { text: 'I will be arriving on...', value: 'arrive' }
            ]
        }
    },
    methods: {
        checkTrains() {
            this.trains = '';
            this.spinner.loading = true;

            const fromStation = 'http://irail.be/stations/NMBS/008813003';
            const toStation = 'http://irail.be/stations/NMBS/008821006';

            this.$http.get('https://api.irail.be/connections/', {
                withCredentials: true,
                headers: {
                    Accept: 'application/json'
                },
                params: {
                    from: this.fromStation || fromStation,
                    to: this.toStation || toStation,
                    timeSel: this.selection,
                    date: this.date,
                    time: this.time,
                    format: 'json'
                }
            }).then((response) => {
                this.spinner.loading = false;
                this.trains = response.data.connection;

                $('html, body').animate({
                    scrollTop: $(".home-main").offset().top - 30
                }, 1000);
            }, (response) => {
                console.error(':(');
            });
        },
        formatUnixTime(time) {
            return moment.unix(time).format('HH:mm');
        },
        formatDuration(seconds) {
            return Math.ceil(seconds / 60);
        }
    },
    components: {
        BeatLoader
    }
}
</script>
