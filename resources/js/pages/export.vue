<template>
    <div class="col-12 pb-5">
        <!--workflow-->
        <transition name="fade">
            <div>
                <div class="delimiter">
                    <eva-icon name="more-vertical-outline"></eva-icon>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center pb-2">
                            <span class="badge-spill">
                                <eva-icon name="flash-outline"></eva-icon>
                            </span>
                            <transition name="fade">
                                <div
                                    v-if="!object || !book_id"
                                    class="badge-spill-notice" role="alert">
                                    {{ !object ? $t('Select object for export') : $t('Select address book') }}
                                </div>
                            </transition>

                        </div>
                        <!--object-->
                        <div class="form-group">
                            <label>{{$t('object')}}</label>
                            <select
                                v-model="object"
                                @change="getObjectVars()"
                                class="form-control">
                                <option value="" disabled selected>{{$t('Choose')}}...</option>
                                <option v-for="objectItem  in objects" :value="objectItem">
                                    {{ $t(objectItem) }}
                                </option>
                            </select>
                        </div>
                        <!--/object-->

                        <!--addressBook-->
                        <div v-if="object" class="form-group">
                            <label>{{$t('Address book')}}</label>
                            <select v-model='book_id' class="form-control">
                                <option value="" disabled selected>{{$t('Choose')}}...</option>
                                <option v-for="addressBook in addressBooks" :value="addressBook.id">
                                    {{addressBook.name}} ({{addressBook.inactive_email_qty}})
                                </option>
                            </select>
                            <small class="form-text text-muted">
                                {{$t('Address Book to which data will be exported')}}
                            </small>
                        </div>
                        <!--/addressBook-->

                    </div>
                </div>
            </div>
        </transition>
        <!--/workflow-->

        <!--mapping-->
        <transition name="fade">
            <div v-if="object && book_id" class="mb-5">
                <div class="delimiter">
                    <eva-icon name="more-vertical-outline"></eva-icon>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                    <span class="badge-spill">
                        <eva-icon name="cube-outline"></eva-icon>
                    </span>
                            <transition name="fade">
                                <div v-if="!hasRequireVar()" class="badge-spill-notice" role="alert">
                                    {{$t('Must have email or phone') }}
                                </div>
                            </transition>
                        </div>
                        <br>
                        <div class="col-12">
                            <div v-for="(mappingItem, index) in mapping" class="pt-1">
                                <!-- once field-->
                                <div class="form-row p-0">
                                    <div class="form-group col-7">
                                        <input
                                            v-model.trim="mappingItem.key"
                                            :placeholder="$t('Input var name')"
                                            type="text" required="required"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-4">
                                        <select v-model="mappingItem.value" class="form-control">
                                            <option value="" disabled selected>{{$t('Choose')}}...</option>
                                            <option v-for="(eventVarValue, eventVarKey) in eventVars"
                                                    v-bind:value="eventVarKey">
                                                {{eventVarValue}} ({{eventVarKey}})
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-1">
                                        <!--delete vars-->
                                        <button @click="errorsStorage.splice(mapping.id, 1); mapping.splice(index ,1)"
                                                class="btn btn-delete-var">
                                            <eva-icon name="close-outline" :width="14" :height="14"></eva-icon>
                                        </button>
                                        <!--/delete vars-->

                                    </div>
                                </div>
                                <!-- /once field-->
                            </div>
                            <div :class="{'text-center':mapping.length === 0}">
                                <!--add var-->
                                <button class="btn btn-add-var"
                                        :class="{'btn-sm':mapping.length !== 0}"
                                        @click="mapping.push({'id': Math.random(1), 'key': '', 'value': ''})">
                                    <eva-icon name="plus-outline" :width="14" :height="14"></eva-icon>
                                    {{$t('Add variable')}}
                                </button>
                                <!--/add var-->
                            </div>

                        </div>

                        <!--doExport-->
                        <transition name="fade">
                            <div v-if="mapping.length>0 && hasRequireVar()" class="col-12 pt-2">
                                <div class="text-center">
                                    <button class="btn btn btn-save" @click="doExport()">{{$t('Export')}}</button>
                                </div>
                            </div>
                        </transition>
                        <!--/doExport-->

                    </div>
                </div>
            </div>
        </transition>
        <!--/mapping-->
    </div>
</template>

<script>
    import {EvaIcon} from 'vue-eva-icons'
    import SwitchAutomationGrid from "../components/SwitchAutomationGrid";
    import axios from "axios";
    import Swal from "sweetalert2";
    import i18n from "../plugins/i18n";
    import store from "../store";
    import router from "../router";

    export default {
        components: {
            SwitchAutomationGrid,
            [EvaIcon.name]: EvaIcon
        },

        middleware: 'auth',

        data: () => ({
            apiUrl: window.config.apiUrl,
            objects: {},
            object: null,

            addressBooks: {},
            book_id: null,

            workflows: ["export", "post"],
            eventVars: {},

            hasError: false,
            errorsStorage: [],
            workflow: null,
            meta: {'book_id': null, 'post_url': null},
            mapping: [],
            event: null,
            is_tracking: false,
            rule: null,
            status: 1,
            name: null,
            created_at: null,
            updated_at: null,
        }),

        metaInfo() {
            return {title: this.$t('Export')}
        },


        created() {
            this.getObjects();
            this.getAddressBooks();
        },

        methods: {
            prepareMappingData(data) {
                var result = [];
                var i = 0;
                for (var key in data) {
                    if (typeof data[key] === 'object') {
                        var collectedIncludesItems = [];
                        for (var itemKey in data[key]) {
                            collectedIncludesItems.push({'id': i++, 'key': itemKey, 'value': data[key][itemKey]});
                        }
                        result.push({'id': i++, 'key': key, 'value': collectedIncludesItems});
                    } else {
                        result.push({'id': i++, 'key': key, 'value': data[key]});
                    }
                }

                return result;
            },

            prepareMappingDataSave() {

                var result = {};
                var subResult = {};

                for (var index in this.mapping) {
                    var key = this.mapping[index]['key'];
                    var value = this.mapping[index]['value'];

                    if (typeof value === 'object') {
                        var collectedCrmVar = {};
                        for (var objIndex in value) {
                            var subKey = value[objIndex]['key'];
                            var subValue = value[objIndex]['value'];
                            subResult[subKey] = subValue
                        }
                        result[key] = subResult;
                    } else {
                        result[key] = value;
                    }
                }
                return result;
            },

            getObjects() {
                axios.get(this.apiUrl + '/object').then(response => {
                    this.objects = response.data;
                }).catch(function (e) {
                    console.log(e.response)
                });
            },

            getObjectVars() {
                axios.get(this.apiUrl + '/object/' + this.object + '/fields').then(response => {
                    this.eventVars = response.data;
                }).catch(function (e) {
                    console.log(e.response.data)
                });
            },

            doExport() {
                axios.post(this.apiUrl + '/export', {
                    object: this.object,
                    book_id: this.book_id,
                    mapping: this.prepareMappingDataSave(),
                }).then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: i18n.t('Pushed into queue'),
                        reverseButtons: true,
                        confirmButtonText: i18n.t('ok'),
                    })
                }).catch(e => {
                    console.log(e.response.data);
                });

            },

            getAddressBooks() {
                axios.get(this.apiUrl + '/addressbooks').then(response => {
                    this.addressBooks = response.data;
                }).catch(function (e) {
                    console.log(e.response);
                });
            },

            hasRequireVar() {
                if (this.countSvar('email') === 0 && this.countSvar('phone') === 0) {
                    this.errorsStorage['requireVar'] = true;
                    return false;
                }

                this.errorsStorage['requireVar'] = false;
                return true;
            },

            countSvar(variable) {
                var counter = 0;
                for (var key in this.mapping) {
                    if (this.mapping[key]['key'] === variable) {
                        counter++;
                    }
                }

                return counter;
            },
        }
    }
</script>
<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }

    .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */
    {
        opacity: 0;
    }
</style>
