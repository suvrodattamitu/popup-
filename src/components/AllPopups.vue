<template>
    <div class="fizzy_content_wrap">
        <div class="fizzy_all_popups" v-loading="loading">
            <el-row>
                <el-col>
                    <predefinedPopup v-model:visibility="showAddFormModal"></predefinedPopup>
                    <welcome v-if="!allPopups.length" v-model="showAddFormModal"></welcome>
                    <div v-else>
                        <div class="fizzy_popup_table">
                            <div class="fizzy_table_actions">
                                <div class="left_actions">
                                    <div class="ninja_bulk_action">
                                        <el-select v-model="bulk_value" clearable placeholder="Select" size="mini">
                                            <el-option
                                            v-for="item in bulkOptions"
                                            :key="item.value"
                                            :label="item.label"
                                            :value="item.value">
                                            </el-option>
                                        </el-select>
                                        <el-button class="ninja_bulk_button" size="mini"  @click="openBulkModal" type="primary">
                                            Apply
                                        </el-button>
                                    </div>
                                </div>
                                <div class="right_actions">
                                    <div class="nina_search_action">
                                        <el-input type="text" size="medium" v-model="search_string"  @keyup.enter="getallPopups">
                                            <template #suffix>
                                                <el-button  size="medium" icon="el-icon-search" @click="getallPopups"></el-button>
                                            </template>
                                        </el-input>
                                    </div>
                                    <div class="ninja_add_new_action">
                                        <el-button size="medium"  @click="showAddFormModal = true" type="primary" icon="el-icon-circle-plus">
                                            Add Popup
                                        </el-button>
                                    </div>
                                </div>
                            </div>
                            <el-table
                                :data="allPopups"
                                @selection-change="handleSelectionChange"
                                style="width: 100%"
                            >
                                <el-table-column
                                type="selection"
                                width="55">
                                </el-table-column>

                                <el-table-column type="expand">
                                <template #default="props">
                                    <p>Title: {{ props.row.post_title }}</p>
                                </template>
                                </el-table-column>

                                <el-table-column
                                label="Name"
                                width="400"
                                >
                                <template #default="scope">
                                    <strong>{{ scope.row.post_title }}</strong>
                                    <div class="row-actions fizzy_row_actions">
                                        <router-link :to="'/popup-editor/'+scope.row.ID">
                                            Edit
                                        </router-link>
                                        |
                                        <a @click="confirmDeletePopup(scope.row)" class="delete_btn">Delete</a>
                                        |
                                        <a @click.prevent="duplicatePopup(scope.row)">Duplicate</a>
                                    </div>
                                </template>
                                </el-table-column>

                                <el-table-column 
                                label="Type"
                                prop="post_content"
                                >
                                
                                </el-table-column>

                                <el-table-column
                                    label="Short Code"
                                    width="350"
                                >
                                <template #default="scope">
                                    <code class="copy"
                                        :data-clipboard-text='`[fizzy_popup_layout id="${scope.row.ID}" ]`'>
                                        <i class="el-icon-document"></i> [fizzy_popup_layout id="{{ scope.row.ID }}"]
                                    </code>
                                </template>
                                </el-table-column>
                            </el-table>
                        </div>

                        <div class="fizzy_pagination">
                            <el-pagination
                                background
                                @size-change="handleSizeChange"
                                @current-change="handleCurrentChange"
                                :current-page="page_number"
                                :page-size="per_page"
                                :page-sizes="pageSizes"
                                layout="total, sizes, prev, pager, next"
                                :total="total">
                            </el-pagination>
                        </div>
                    </div>
                </el-col>
            </el-row>

            <!--Delete form Confimation Modal-->
            <el-dialog
                    title="Are You Sure, You want to delete this Popup?"
                    v-model="deleteDialogVisible"
                    :before-close="handleDeleteClose"
                    width="60%">
                <div class="modal_body">
                    <p>All the data assoscilate with this popup will be deleted</p>
                    <p>You are deleting popup id: <b>{{ deletingPopup.ID }}</b>. <br/>Popup Title: <b>{{
                        deletingPopup.post_title }}</b></p>
                </div>
                <template #footer>
                    <span class="dialog-footer">
                        <el-button @click="deleteDialogVisible = false">Cancel</el-button>
                        <el-button type="primary" @click="deletePopupNow()">Confirm</el-button>
                    </span>
                </template>
            </el-dialog>

            <!--Bulk form Confimation Modal-->
            <el-dialog
                    :title="`Are You Sure, You want to ${bulk_value} this Popup?`"
                    v-model="showBulkModal"
                    :before-close="handleBulkClose"
                    width="60%">
                <div class="modal_body">
                    <p>All the data assoscilate with this popup will {{bulk_value}}</p>
                </div>
                <template #footer>
                    <span class="dialog-footer">
                        <el-button @click="showBulkModal = false">Cancel</el-button>
                        <el-button type="primary" @click="bulkActionNow()">Confirm</el-button>
                    </span>
                </template>
            </el-dialog>
        </div>
    </div>
</template>

<style lang="scss">
    .fizzy_all_popups{
        .el-input__suffix{
            right: 0px !important;
        }
        .fizzy_pagination, .ninja_bulk_action{
            float:right;
            margin:15px 0px;
            .el-input__inner{
                background-color: #fff;
            }
        }
        .fizzy_popup_table{
            .fizzy_table_actions{
                display: flex;
                margin:15px 0px;
                align-items: center;
                justify-content: space-between;

                .ninja_bulk_button{
                    margin-left:5px;
                }
                .right_actions{
                    display:flex;
                    .ninja_add_new_action {
                        margin-left:15px;
                    }
                }
            }
        }
        .fizzy_row_actions{
            a{
                text-decoration: none;
                cursor:pointer;
                &.delete_btn{
                   color:#ff0000; 
                }
            } 
        }
    }
</style>

<script type="text/babel">
    import predefinedPopup from '../components/modals/predefinedPopup.vue';
    import Welcome from './editor-ui/pieces/Welcome.vue';
    import Clipboard from 'clipboard';

    export default {
        components:{
            predefinedPopup,
            Welcome
        },
        data() {
            return {
                showBulkModal: false,
                bulk_value: '',
                bulkOptions: [{
                    value: '',
                    label: 'Bulk actions'
                },{
                    value: 'delete',
                    label: 'Delete'
                }],
                showAddFormModal: false,
                loading: false,
                allPopups: [],
                multipleSelection: [],
                deletingPopup: {},
                deleteDialogVisible: false,
                //pagination
                per_page: 5,
                page_number: 1,
                total: 0,
                pageSizes: [5,10, 20, 30, 40, 50],
                search_string: '',
            }
        },
        methods: {
            openBulkModal() {
                if(this.multipleSelection.length && this.bulk_value) {
                    this.showBulkModal = true;
                }
            },
            //multiple select
            handleSelectionChange(val) {
                this.multipleSelection = val;
            },
            //pagination
            handleSizeChange(val) {
                this.per_page = val;
                this.getallPopups();
            },
            handleCurrentChange(val) {
                this.page_number = val;
                this.getallPopups();
            },
            getallPopups(){
                this.loading = true
                this.$adminGet({
                    route: 'get_all_popups',
                    per_page: this.per_page,
                    page_number: this.page_number,
                    search_string: this.search_string
                })
                    .then(response => {
                        if( response.data ) {
                            this.allPopups = response.data.allPopups
                            //pagination
                            this.total = response.data.total
                        }
                    }).fail(error => {

                    }).always(() => {
                        this.loading = false
                    });
            },
            confirmDeletePopup(popup) {
                this.deletingPopup = popup;
                this.deleteDialogVisible = true;
            },
            deletePopupNow(){
                this.loading = true;
                this.$adminPost({
                    route: 'delete_popup',
                    popup_id: this.deletingPopup.ID
                })
                    .then(response => {
                        if( response.data ) {
                            this.$message({
                                showClose: true,
                                message: response.data.message,
                                type: 'success'
                            });
                            this.getallPopups();
                        }
                    }).fail(error => {

                    }).always(() => {
                        this.deleteDialogVisible = false;
                        this.deletingPopup = {}
                        this.loading = false;
                    });
            },
            bulkActionNow() {
                if( this.bulk_value && this.multipleSelection.length ) {
                    this.loading = true;
                    this.$adminPost({
                        route: 'bulk_action',
                        bulk_value: this.bulk_value,
                        popup_ids: JSON.stringify(this.multipleSelection)
                    })
                        .then(response => {
                            if( response.data ) {
                                this.$message({
                                    showClose: true,
                                    message: response.data.message,
                                    type: 'success'
                                });
                                this.getallPopups();
                            }
                        }).fail(error => {

                        }).always(() => {
                            this.showBulkModal = false;
                            this.multipleSelection = [];
                            this.bulk_value = '';
                            this.loading = false;
                        });
                }
            },
            handleDeleteClose(){
                this.deleteDialogVisible = false;
                this.deletingPopup = {}
            },
            handleBulkClose() {
                this.showBulkModal = false;
                this.multipleSelection = [];
                this.bulk_value = '';
            },
            duplicatePopup(popup){
                this.loading = true;
                this.$adminPost({
                    route: 'duplicate_popup',
                    popup_id: popup.ID
                })
                    .then(response => {
                        if( response.data ) {
                            this.$message({
                                showClose: true,
                                message: response.data.message,
                                type: 'success'
                            });
                            let popupId = response.data.popup_id
                            this.$router.push('/popup-editor/'+popupId)
                        }
                    }).fail((error) => {

                    }).always(() => {
                        this.loading = false;
                    });
            },
            clipboard(){
                if( !window.clipboard ){
                    window.clipboard = new Clipboard('.copy');
                        window.clipboard.on('success', (e) => {
                        let message = 'Shortcode is Copied!'
                        this.$message({
                            showClose: true,
                            message: message,
                            type: 'success'
                        });
                    });
                }
            }
        },
        mounted(){
            this.getallPopups();
            this.clipboard();
        }
    }
</script>