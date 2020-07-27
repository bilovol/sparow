<template>
    <div class="col-12 pb-5">
        <!--top-->
        <transition name="fade">
            <div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center pb-2">
                            <div class="mr-auto">
                        <span class="badge-spill">
                            <eva-icon name="bulb-outline"></eva-icon>
                        </span>
                            </div>
                            <button v-if="showDeleteBtn" @click="desintegration()" class="btn btn-delete float-right">
                                {{$t('Delete')}}
                            </button>
                        </div>
                        <div class="form-row">
                            <!--name-->
                            <div class="form-group col-md-9">
                                <label>{{$t('Name')}}</label>
                                <input v-model.trim="name" type="text" class="form-control">
                            </div>
                            <!--/name-->

                            <!--status-->
                            <div class="form-group col-md-3">
                                <label>{{$t('Status')}}</label>
                                <select
                                    v-model="status"
                                    class="form-control">
                                    <option v-for="value_status in statuses" :value="value_status">
                                        {{ value_status === '0' ? $t('disable') : $t('active') }}
                                    </option>
                                </select>
                            </div>
                            <!--/status-->
                        </div>

                        <!--event-->
                        <div class="form-group">
                            <label>{{$t('Event')}}</label>
                            <select
                                v-model="event"
                                @change="getEventVars()"
                                class="form-control">
                                <option value="" disabled selected>{{$t('Choose')}}...</option>
                                <option v-for="item_event in events" :value="item_event">
                                    {{$t(item_event)}}
                                </option>
                            </select>

                            <small class="form-text text-muted">
                                {{$t('An event in your system to track')}}
                            </small>
                        </div>
                        <!--/event-->
                    </div>
                </div>
            </div>
        </transition>
        <!--/top-->

        <!--workflow-->
        <transition name="fade">
            <div v-if="event">
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
                                    v-if="(workflow === 'export' && !meta.book_id) || (workflow === 'post' && !meta.post_url)"
                                    class="badge-spill-notice" role="alert">
                                    {{ workflow==='export' ? $t('Select address book') : $t('Input POST URL') }}
                                </div>
                            </transition>
                        </div>
                        <!--workflow-->
                        <div class="form-group">
                            <label>{{$t('Workflow')}}</label>
                            <select
                                v-model="workflow"
                                class="form-control">
                                <option value="" disabled selected>{{$t('Choose')}}...</option>
                                <option v-for="workflowItem  in workflows" :value="workflowItem">
                                    {{ $t(workflowItem) }}
                                </option>
                            </select>
                        </div>
                        <!--/workflow-->

                        <!--addressBook-->
                        <div v-if="workflow === 'export'" class="form-group">
                            <label>{{$t('Address book')}}</label>
                            <select v-model='meta.book_id' class="form-control">
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

                        <!--post-->
                        <div v-if="workflow === 'post'" class="form-group">
                            <label>POST URL</label>
                            <input v-model.trim='meta.post_url' type="text" class="form-control">
                            <small class="form-text text-muted">
                                {{$t('POST URL event in A360 SendPulse')}}
                            </small>
                        </div>
                        <!--/post-->

                    </div>
                </div>
            </div>
        </transition>
        <!--/workflow-->

        <!--mapping-->
        <transition name="fade">
            <div v-if="(workflow === 'export' && meta.book_id) || (workflow === 'post' && meta.post_url)" class="mb-5">
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
                                    {{workflow==='export'
                                    ? $t('Must have email or phone')
                                    : $t('Must have email and phone')}}
                                </div>
                            </transition>
                        </div>
                        <br>
                        <div class="col-12">
                            <div v-for="(mappingItem, index) in mapping" class="pt-1">
                                <!-- once field-->
                                <div v-if="typeof mappingItem.value !=='object'" class="form-row p-0">
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

                                <!-- multiply field-->
                                <div v-if="typeof mappingItem.value ==='object' && workflow === 'post'">

                                    <div class="form-row p-0 pt-1 pb-2">
                                        <div class="form-group col-7">
                                            <input v-model.trim="mappingItem.key" type="text" required="required"
                                                   placeholder="localization.user_var"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group col-4"></div>
                                        <div class="form-group col-1">
                                            <!--delete structure-->
                                            <button
                                                @click="errorsStorage.splice(mapping.id, 1); mapping.splice(index ,1)"
                                                class="btn btn-delete-var">
                                                <eva-icon name="close-outline" :width="14" :height="14"></eva-icon>
                                            </button>
                                            <!--/delete structure-->

                                        </div>
                                        <div class="col-12 p-4 structure-block">
                                            <!--multiply item-->
                                            <div v-for="(objectMappingItem, objectMappingIndex) in mappingItem.value"
                                                 class="form-row p-0 pt-1">
                                                <div class="form-group col-7">
                                                    <input v-model.trim="objectMappingItem.key" type="text"
                                                           required="required"
                                                           placeholder="localization.user_var"
                                                           class="form-control">
                                                </div>
                                                <div class="form-group col-4">
                                                    <select v-model="objectMappingItem.value" class="form-control">
                                                        <option value="" disabled selected>{{$t('Choose')}}...</option>
                                                        <option v-for="(eventVarValue, eventVarKey) in eventVars"
                                                                v-bind:value="eventVarKey">
                                                            {{eventVarValue}} ({{eventVarKey}})
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-1">
                                                    <!--delete sub vars-->
                                                    <button
                                                        @click="errorsStorage.splice(objectMappingItem.id, 1); mappingItem.value.splice(objectMappingIndex ,1)"
                                                        class="btn btn-delete-var">
                                                        <eva-icon name="close-outline" :width="14"
                                                                  :height="14"></eva-icon>
                                                    </button>
                                                    <!--/delete sub vars-->
                                                </div>
                                            </div>
                                            <!--/multiply item-->

                                            <!--add sub var-->
                                            <button class="btn btn-add-var btn-sm"
                                                    @click="mappingItem.value.push({'id': Math.random(1), 'key': '', 'value': ''})">
                                                <eva-icon name="plus-outline" :width="14" :height="14"></eva-icon>
                                                {{$t('Add variable')}}
                                            </button>
                                            <!--/add sub var-->
                                        </div>
                                        <!--multiply item-->

                                    </div>


                                </div>
                                <!-- /multiply field-->
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

                                <!--add structure-->
                                <button v-if="workflow === 'post'" class="btn btn-add-var ml-2"
                                        :class="{'btn-sm':mapping.length !== 0}"
                                        @click="mapping.push({'id': Math.random(1), 'key': '', 'value': [{'id':Math.random(1),'key':'','value':''}]})">
                                    <eva-icon name="plus-outline" :width="14" :height="14"></eva-icon>
                                    {{$t('Add structure')}}
                                </button>
                                <!--/add structure-->
                            </div>

                        </div>

                        <!--save-->
                        <transition name="fade">
                            <div v-if="mapping.length>0 && hasRequireVar()" class="col-12 pt-2">
                                <div class="text-center">
                                    <button class="btn btn btn-save" @click="save()">{{$t('Save')}}</button>
                                </div>
                            </div>
                        </transition>
                        <!--/save-->

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
            showDeleteBtn: false,
            statuses: ["1", "0"],
            events: {},
            workflows: ["export", "post"],
            eventVars: {},
            addressBooks: {},

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
            return {title: this.$t('Automation')}
        },


        created() {
            this.getEvents();
            if (this.$route.params.id && this.$route.params.id !== 'new') {
                this.getAutomation();
                this.showDeleteBtn = true;
            } else {
                var date = new Date();
                this.name = this.$t('My automation') + ' ' + date.getTime();
            }
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

            getEvents() {
                axios.get(this.apiUrl + '/event').then(response => {
                    this.events = response.data;
                }).catch(function (e) {
                    console.log(e.response)
                });
            },

            getEventVars() {
                axios.get(this.apiUrl + '/event/' + this.event + '/fields').then(response => {
                    this.eventVars = response.data;
                }).catch(function (e) {
                    console.log(e.response.data)
                });
            },

            save() {
                axios.post(this.apiUrl + '/automation/' + this.$route.params.id, {
                    name: this.name,
                    workflow: this.workflow,
                    status: this.status,
                    meta: this.meta,
                    mapping: this.prepareMappingDataSave(),
                    event: this.event
                }).then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: i18n.t('Saved'),
                        reverseButtons: true,
                        confirmButtonText: i18n.t('ok'),
                    }).then(() => {
                        if (this.$route.params.id === 'new') {
                            router.push({name: 'automation'})
                        }
                    })
                }).catch(e => {
                    console.log(e.response.data);
                });

            },

            desintegration() {
                Swal.fire({
                    icon: 'warning',
                    title: i18n.t('Are you sure?'),
                    reverseButtons: true,
                    confirmButtonText: i18n.t('Yes delete!'),
                    confirmButtonColor: '#ff3d70',
                    showCancelButton: true,
                    cancelButtonText: i18n.t('Cancel')
                }).then((result) => {
                    if (result.value) {
                        axios.delete(this.apiUrl + '/automation/' + this.$route.params.id).then(response => {
                            router.push({name: 'automation'})
                        }).catch(e => {
                            console.log(e.response.data);
                        });
                    }
                })


            },

            getAutomation() {
                axios.get(this.apiUrl + '/automation/' + this.$route.params.id).then(response => {
                    this.workflow = response.data.workflow;
                    this.meta = response.data.meta;
                    this.mapping = this.prepareMappingData(response.data.mapping);
                    this.event = response.data.event;
                    this.is_tracking = response.data.is_tracking;
                    this.rule = response.data.rule;
                    this.status = response.data.status;
                    this.name = response.data.name;
                    this.created_at = response.data.created_at;
                    this.updated_at = response.data.updated_at;

                    this.getEventVars();
                }).catch(function (e) {
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
                if (this.workflow === 'export') {
                    if (this.countSvar('email') === 0 && this.countSvar('phone') === 0) {
                        this.errorsStorage['requireVar'] = true;
                        return false;
                    }
                }
                if (this.workflow === 'post') {
                    if (this.countSvar('email') === 0 || this.countSvar('phone') === 0) {
                        this.errorsStorage['requireVar'] = true;
                        return false;
                    }
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
