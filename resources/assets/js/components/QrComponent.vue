<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6" :class="{'col-md-offset-3' : qrs.length <= 0 }">
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">{{config.langs.qr.title}}</div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form">
                                    <div class="form-group has-error text-center" v-if="serrors">
                                        <label class="col-md-3"></label>
                                        <div class="col-md-9">
                                            <span class="help-block" v-for="(error, i) in serrors" v-bind:key="i">{{ error }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group has-success text-center" v-if="success">
                                        <label class="col-md-3"></label>
                                        <div class="col-md-9">
                                            <span class="help-block">{{ success }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group" :class="{'has-error' : (errors.has('mail')) }">
                                        <label class="col-md-3">{{config.langs.email.title}}</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="email" name="mail" v-model="mail">
                                            <span class="help-block" v-show="errors.has('mail')">{{ errors.first('mail') }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group" :class="{'has-error' : (errors.has('full_name') || errors.has('min') ) }">
                                        <label class="col-md-3">{{config.langs.full_name.title}}</label>
                                        <div class="col-md-9">
                                            <input class="form-control" name="full_name" type="text" v-model="full_name">
                                            <span class="help-block" v-show="errors.has('full_name')">{{ errors.first('full_name') }}</span>                        
                                        </div>
                                    </div>
                                    <div class="form-group" :class="{'has-error' : ( errors.has('mobile') ) }">
                                        <label class="col-md-3">{{config.langs.mobile.title}}</label>
                                        <div class="col-md-9">
                                            <input class="form-control"  name="mobile" type="text" v-model="mobile">
                                            <span class="help-block" v-show="!errors.has('mobile')">Có thể nhập nhiều số điện thoại cách nhau bởi dấu "," và khoảng trống</span>
                                            <span class="help-block" v-show="!errors.has('mobile')">Ví dụ: 0974389718, 0912354789, 0812354678</span>
                                            <span class="help-block" v-show="errors.has('mobile')">{{ errors.first('mobile') }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group" :class="{'has-error' : ( errors.has('country_code') || errors.has('state_code') || errors.has('city_code') || errors.has('street') ) }">
                                        <label class="col-md-3">{{config.langs.address.title}}</label>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <select class="form-control" name="country_code" v-model="country_code" @change="getStates">
                                                        <option v-for="(country,i) in countries" v-bind:key="i" :value="country.iso_a2">{{country.name}}</option>
                                                    </select>
                                                    <span class="help-block" v-show="errors.has('country_code')">{{ errors.first('country_code') }}</span>
                                                
                                                </div>
                                                <div class="col-md-4" v-if="states.length > 0">
                                                    <select class="form-control" name="state_code" v-model="state_code" @change="getCities">
                                                        <option v-for="(state,i) in states" v-bind:key="i" :value="state.iso">{{state.name}}</option>
                                                    </select>
                                                    <span class="help-block" v-show="errors && errors.has('state_code')">{{ errors.first('state_code') }}</span>
                                                </div>
                                                <div class="col-md-4" v-if="cities.length > 0">

                                                    <select class="form-control" name="city_code" v-model="city_code">
                                                        <option v-for="(city,i) in cities" v-bind:key="i" :value="city.code">{{city.name}}</option>
                                                    </select>
                                                    <span class="help-block" v-show="errors && errors.has('city_code')">{{ errors.first('city_code') }}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <br>
                                                    <input type="text" name="street" class="form-control" v-model="street">
                                                    <span class="help-block" v-show="errors.has('street')">{{ errors.first('street') }}</span>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" :class="{'has-error' : (errors.has('size') ) }">
                                        <label class="col-md-3">{{config.langs.size.title}}</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="size" v-model="size">
                                            <span class="help-block" v-show="errors.has('size')">{{ errors.first('size') }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-3">
                                            <button type="button" class="btn btn-default btn-lg pull-left" @click="clearErrors">{{config.langs.button.reset}}</button>
                                            <button v-if="!processing" :disabled="errors.any()" type="button" class="btn btn-success btn-lg pull-right" @click="validateForm">{{config.langs.button.create}}</button>
                                            <button v-if="processing" :disabled="processing" type="button" class="btn btn-primary btn-lg pull-right"><i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>&nbsp;{{config.langs.button.processing}}</button>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6" v-if="qrs.length > 0">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ config.langs.qr.list }}</div>
                        <div class="panel-body">
                            <div class="row" v-for="(qr, i) in qrs" v-bind:key="i">
                                <div class="col-md-3">
                                    <a :href="/qrs/+qr.id">
                                        <img class="img-responsive img-fluid" :src="qr.link">
                                    </a>
                                </div>
                                <div class="col-md-9">
                                    <p>{{ config.langs.full_name.title }}: {{qr.full_name}}</p>
                                    <p>{{ config.langs.mobile.title }}: {{qr.mobile}}</p>
                                    <p>{{ config.langs.address.title }}: {{qr.street}}{{qr.cityName ? ', '+qr.cityName: ''}}{{qr.stateName ? ', ' + qr.stateName : ''}}{{qr.countryName ? ', ' + qr.countryName : ''}}</p>
                                    <p>{{ config.langs.size.title }}: {{qr.size}}</p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import { config } from '../config';
    //import { sprintf } from "sprintf-js";
    import { Validator } from 'vee-validate';
    
    const dictionary = {
        custom: {
            mail: {
                required: 'Email là bắt buộc.',
                email:'Email không hợp lệ.'
            },
            full_name: {
                required: 'Họ tên bắt buộc nhập.',
                min:'Họ tên ít nhất 3 ký tự.'
            },
            mobile:{
                required: 'Điện thoại là bắt buộc.',
                regex:'Định dạng số điện thoại không đúng'
            },
            country_code:{
                required: 'Quốc gia là bắt buộc.',
            },
            state_code:{
                required: 'Tỉnh thành là bắt buộc.',
            },
            city_code:{
                required: 'Thành phố là bắt buộc.',
            },
            street:{
                required: 'Địa chỉ là bắt buộc.',
            },
            size:{
                required: 'Kích thước là bắt buộc',
                between:'Kích thước là số nguyên trong khoảng 780 - 1920 pixel.'
            }
        },
        en:{
           attributes:{
                mail:'Email',
                full_name:'full name',
                country_code:'country',
                state_code :'state',
                city_code:'city',
           } 
        }
    };

    Validator.localize(config.lang, dictionary);

    export default {
        name:'qr-component',
        validator: null,
        data(){
            return {
                processing: false,
                config:config,
                errors: null,
                serrors:[],
                success:'',
                countries:[],
                states:[],
                cities:[],
                mail:'',
                size:'1024',
                full_name:'',
                mobile:'',
                street:'',
                city_code:'',
                state_code:'',
                country_code:'VN',
                qrs:[],
            }
        },
        watch: {
            mail(value) {
                this.validator.validate('mail', value);
            },
            full_name(value) {
                this.validator.validate('full_name', value);
            },
            mobile(value) {
                this.validator.validate('mobile', value);
            },
            country_code(value) {
                this.validator.validate('country_code', value);
            },
            state_code(value) {
                this.validator.validate('state_code', value);
            },
            city_code(value) {
                this.validator.validate('city_code', value);
            },
            street(value) {
                this.validator.validate('street', value);
            },
            size(value) {
                this.validator.validate('size', value);
            }
        },
        mounted(){
            this.init()
        },
        created() {
            //
            this.validator = new Validator({
                mail: 'required|email',
                full_name: 'required|min:3',
                mobile: {
                    required:true,
                    regex:/^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d/
                },
                country_code: 'required',
                state_code: 'required',
                city_code: 'required',
                street: 'required',
                size: 'required|between:780,1920',
            });
            this.$set(this, 'errors', this.validator.errors);
            //this.validator.localize(config.lang, dictionary);
        },
        methods:{
            init() {
                this.getCountries();
                this.getStates();
                
            },
            getCountries() {
                this.countries = [];
                this.states = [];
                this.cities = [];
                axios.post( config.getCountries, {
                })
                .then( (response) => {
                    this.countries =  response.data.countries || [];
                    
                })
                .catch( (error) => {
                    console.log(error);
                });
            },
            getStates() {
                this.states = [];
                this.cities = [];
                axios.post( config.getStates, {
                    country_code: this.country_code
                })
                .then( (response) => {
                    this.states =  response.data.states || [];
                })
                .catch( (error) => {
                    console.log(error);
                });
            },
            getCities() {
                this.cities = [];
                axios.post( config.getCities, {
                    country_code: this.country_code,
                    state_code: this.state_code
                })
                .then( (response) => {
                    this.cities =  response.data.cities || [];
                })
                .catch( (error) => {
                    console.log(error);
                });
            },
            renderQr(){
                this.serrors = [];
                this.success = '';
                this.processing = true;
                axios.post( config.qrRenderUrl, {
                    info:{
                        full_name:this.full_name,
                        mobile: this.mobile,
                        country_code: this.country_code,
                        state_code: this.state_code,
                        city_code: this.city_code,
                        street: this.street,
                        size: this.size
                    },
                    email:this.mail,
                    
                })
                .then( (response) => {
                    if( parseInt(response.data.error) == 0){
                        let url = response.data.url|| '';
                        let qr = response.data.qr||{};
                        if( qr.id ) {
                            qr.url = url;
                            qr.link = url + qr.file;
                        }
                        this.qrs.unshift(qr);
                        this.success = response.data.message;
                        this.resetForm();
                    }
                    else {
                        this.serrors = [];
                        this.serrors = response.data.message;
                    }
                    this.processing = false;
                })
                .catch( (error) => {
                    console.log(error);
                    this.processing = false;
                });
            },
            resetForm(){
                this.full_name = '';
                this.mobile = '';
                this.street = '';
                this.resetMessage();  
            },
            resetMessage(){
                setTimeout(()=> {
                    this.serrors = [];
                    this.success = null;
                }, 5000);
            },
            seenState(){
                return this.states.length > 0 ? true : false;
            },
            seenCity(){
                return this.states.length > 0 ? true : false;
            },
            validateForm() {
                let config = {
                    mail: this.mail,
                    full_name: this.full_name,
                    mobile:this.mobile,
                    country_code:this.country_code,
                    street: this.street,
                    size: this.size
                };
                if( this.states.length > 0 ) {
                    config.state_code = this.state_code;
                }
                if( this.cities.length > 0 ){
                    config.city_code = this.city_code;
                }
                this.validator.validateAll(config).then((result) => {
                    if (result) {
                        this.renderQr();
                        return;
                    }
                });
            },
            clearErrors() {
                this.errors.clear();
            }
        }
    }
</script>
