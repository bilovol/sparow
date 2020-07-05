<template>
    <div class="col-12">
        <div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center pb-2">
                        <div class="mr-auto">
                        <span class="badge-spill">
                            <eva-icon name="bulb-outline"></eva-icon>
                        </span>
                        </div>
                        <button v-if="showDeleteBtn" class="btn btn-delete float-right">Удалить</button>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-9">
                            <label>Имя</label>
                            <input v-model.trim="name" type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Статус</label>
                            <select
                                v-model="status"
                                class="form-control">
                                <option v-for="value_status in statuses" v-bind:value="value_status">
                                    {{ value_status === '0' ? $t('disable') : $t('active') }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Событие в амгазине</label>
                        <select
                            v-model="source"
                            @change="getSourceVars()"
                            class="form-control">
                            <option value="" disabled selected>{{$t('select source')}}</option>
                            <option v-for="item_source in sources">
                                {{$t(item_source)}}
                            </option>
                        </select>

                        <small class="form-text text-muted">
                            Событие в магазине которое отслеживать
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="source">
            <div class="delimiter">
                <eva-icon name="more-vertical-outline"></eva-icon>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center pb-2">
                    <span class="badge-spill">
                        <eva-icon name="flash-outline"></eva-icon>
                    </span>
                    </div>
                    <div class="form-group">
                        <label>Действие</label>
                        <select
                            v-model="workflow"
                            class="form-control">
                            <option value="" disabled selected>---</option>
                            <option v-for="(workflow_value, workflow_key)  in workflows" v-bind:value="workflow_value">
                                {{ $t(workflow_key) }}
                            </option>
                        </select>
                    </div>
                    <div v-if='workflow === 0' class="form-group">
                        <label>Книга</label>
                        <select v-model='meta.book_id' class="form-control">
                            <option selected>Choose...</option>
                            <option v-for="addressBook in addressBooks" :value="addressBook.id">
                                {{addressBook.name}} ({{addressBook.inactive_email_qty}})
                            </option>
                        </select>
                        <small class="form-text text-muted">
                            Книга в которую будут экспортироваться данные
                        </small>
                    </div>
                    <div v-if='workflow === 1' class="form-group">
                        <label>POST URL</label>
                        <input v-model.trim='meta.post_url' type="text" class="form-control">
                        <small class="form-text text-muted">
                            POST URL события в A360 SendPulse
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="(workflow === 0 && meta.book_id) || (workflow === 1)">
            <div class="delimiter">
                <eva-icon name="more-vertical-outline"></eva-icon>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                    <span class="badge-spill">
                        <eva-icon name="cube-outline"></eva-icon>
                    </span>
                    </div>
                    <br>
                    <div class="col-12">

                        <!-- once field-->
                        <div v-for="(mappingItem, index ) in mapping" class="form-row p-0 pt-1">
                            <div class="form-group col-7">
                                <input
                                    v-model.trim="mappingItem.key"
                                    type="text" required="required"
                                    class="form-control">
                            </div>
                            <div class="form-group col-4">
                                <select v-model="mappingItem.value" class="form-control">
                                    <option selected>{{index}}</option>
                                    <option v-for="(sourceVarValue, sourceVarKey) in sourceVars">
                                        {{sourceVarKey}} ({{sourceVarValue}})
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-1">
                                <button @click="mapping.splice(index ,1)"
                                        class="btn btn-delete-var">
                                    <eva-icon name="close-outline"></eva-icon>
                                </button>
                            </div>
                        </div>


                        <!--                        structure-->
                        <div class="form-row p-0 pt-1">
                            <div class="form-group col-7">
                                <input type="text" required="required" placeholder="localization.user_var"
                                       class="form-control">
                            </div>
                            <div class="form-group col-4"></div>
                            <div class="form-group col-1">
                                <button class="btn btn-delete-var">
                                    <eva-icon name="close-outline"></eva-icon>

                                </button>
                            </div>
                            <div class="col-12 p-4 structure-block">
                                <div class="form-row p-0 pt-1">
                                    <div class="form-group col-7">
                                        <input type="text" required="required" placeholder="localization.user_var"
                                               class="form-control">
                                    </div>
                                    <div class="form-group col-4">
                                        <select class="form-control">
                                            <option selected>Choossses.ы.ффs.</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-1">
                                        <button class="btn btn-delete-var">
                                            <eva-icon name="close-outline"></eva-icon>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="delimiter">
                <eva-icon name="more-vertical-outline"></eva-icon>
            </div>
            <div class="text-center mb-5">
                <button class="btn btn-lg btn-save">Сохранить</button>
            </div>
        </div>
    </div>
</template>

<script>
    import {EvaIcon} from 'vue-eva-icons'
    import SwitchAutomationGrid from "../components/SwitchAutomationGrid";
    import axios from "axios";

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
            sources: {},
            workflows: {'export': 0, 'post': 1},
            sourceVars: {},
            addressBooks: {},

            hasError: false,
            webhook_id: null, //todo можжно загнать в hidden
            workflow: null,
            meta: {'book_id': null, 'post_url': null},
            mapping: [],
            source: null,
            is_tracking: false,
            rule: null,
            status: 1,
            name: null,
            created_at: null,
            updated_at: null,
        }),

        metaInfo() {
            return {title: this.$t('automation')}
        },


        created() {
            this.getSources();
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
                for (var key in data) {
                    if (typeof data[key] === 'object') {
                        var collectedIncludesItems = [];
                        for (var itemKey in data[key]) {
                            collectedIncludesItems.push({'id': i++, 'key': itemKey, 'value': data[key][itemKey]});
                        }
                        result.push({'key': key, 'value': collectedIncludesItems});
                    } else {
                        result.push({'key': key, 'value': data[key]});
                    }
                }

                return result;
            },

            getSources() {
                axios.get(this.apiUrl + '/source').then(response => {
                    this.sources = response.data;
                }).catch(function (e) {
                    console.log(e.response)
                });
            },
            getSourceVars() {
                axios.get(this.apiUrl + '/source/' + this.source).then(response => {
                    this.sourceVars = response.data;
                }).catch(function (e) {
                    console.log(e.response)
                });
            },
            getAutomation() {
                axios.get(this.apiUrl + '/automation/' + this.$route.params.id).then(response => {
                    this.webhook_id = response.data.webhooks_id;
                    this.workflow = response.data.workflow;
                    this.meta = response.data.meta;
                    this.mapping = this.prepareMappingData(response.data.mapping);
                    this.source = response.data.source;
                    this.is_tracking = response.data.is_tracking;
                    this.rule = response.data.rule;
                    this.status = response.data.status;
                    this.name = response.data.name;
                    this.created_at = response.data.created_at;
                    this.updated_at = response.data.updated_at;

                    this.getSourceVars();
                }).catch(function (e) {
                    console.log(e.response);
                });
            },

            getAddressBooks() {
                axios.get(this.apiUrl + '/addressbooks').then(response => {
                    console.log(response.data);
                    this.addressBooks = response.data;
                }).catch(function (e) {
                    console.log(e.response);
                });
            }
        }
    }
</script>
