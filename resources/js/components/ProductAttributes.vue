<template>
    <div>
        <div class="tile">
            <h3 class="tile-title">Thuộc tính</h3>
            <hr>
            <div class="tile-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="parent">Chọn một thuộc tính <span class="m-l-5 text-danger"> *</span></label>
                            <select id=parent class="form-control custom-select mt-15" v-model="attribute"
                                @change="selectAttribute(attribute)">
                                <option :value="attribute" v-for="attribute in attributes"> {{ attribute.name }} </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tile" v-if="attributeSelected">
            <h3 class="tile-title">Thêm thuộc tính vào sản phẩm</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="values">Chọn giá trị <span class="m-l-5 text-danger"> *</span></label>
                        <select id=values class="form-control custom-select mt-15" v-model="value"
                            @change="selectValue(value)">
                            <option :value="value" v-for="value in attributeValues"> {{ value.value }} </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" v-if="valueSelected">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="quantity">Số lượng</label>
                        <input class="form-control" type="number" id="quantity" v-model="currentQty" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="price">Giá</label>
                        <input class="form-control" type="text" id="price" v-model="currentPrice" />
                        <small class="text-danger">Giá này sẽ được thêm vào giá của sản phẩm bên trang khách hàng.</small>
                    </div>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-sm btn-primary" @click="addProductAttribute()">
                        <i class="fa fa-plus"></i> Thêm
                    </button>
                </div>
            </div>
        </div>
        <div class="tile">
            <h3 class="tile-title">Thuộc tính sản phẩm</h3>
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr class="text-center">
                                <th>Giá trị</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="pa in productAttributes">
                                <td style="width: 25%" class="text-center">{{ pa.value }}</td>
                                <td style="width: 25%" class="text-center">{{ pa.quantity }}</td>
                                <td style="width: 25%" class="text-center">{{ pa.price }}</td>
                                <td style="width: 25%" class="text-center">
                                    <button class="btn btn-sm btn-danger" @click="deleteProductAttribute(pa)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "product-attributes",
    props: ['productid'],
    data() {
        return {
            productAttributes: [],
            attributes: [],
            attribute: {},
            attributeSelected: false,
            attributeValues: [],
            value: {},
            valueSelected: false,
            currentAttributeId: '',
            currentValue: '',
            currentQty: '',
            currentPrice: '',
        }
    },
    created: function () {
        this.loadAttributes();
        this.loadProductAttributes(this.productid);
    },
    methods: {
        loadProductAttributes(id) {
            let _this = this;
            axios.post('/admin/products/attributes', {
                id: id
            }).then(function (response) {
                _this.productAttributes = response.data;
            }).catch(function (error) {
                console.log(error);
            });
        },
        loadAttributes() {
            let _this = this;
            axios.get('/admin/products/attributes/load').then(function (response) {
                _this.attributes = response.data;
            }).catch(function (error) {
                console.log(error);
            });
        },
        selectAttribute(attribute) {
            let _this = this;
            this.currentAttributeId = attribute.id;
            axios.post('/admin/products/attributes/values', {
                id: attribute.id
            }).then(function (response) {
                _this.attributeValues = response.data;
            }).catch(function (error) {
                console.log(error);
            });
            this.attributeSelected = true;
        },
        selectValue(value) {
            this.valueSelected = true;
            this.currentValue = value.value;
            this.currentQty = value.quantity;
            this.currentPrice = value.price;
        },
        addProductAttribute() {
            if (this.currentQty === null || this.currentPrice === null) {
                this.$swal("Có lỗi xảy ra.", {
                    icon: "error",
                });
            } else {
                let _this = this;
                let data = {
                    attribute_id: this.currentAttributeId,
                    value: this.currentValue,
                    quantity: this.currentQty,
                    price: this.currentPrice,
                    product_id: this.productid,
                };

                axios.post('/admin/products/attributes/add', {
                    data: data
                }).then(function (response) {
                    _this.$swal("Thêm thuộc tính thành công!", {
                        icon: "success",
                    });
                    _this.currentValue = '';
                    _this.currentQty = '';
                    _this.currentPrice = '';
                    _this.valueSelected = false;
                    _this.loadProductAttributes(_this.productid);
                }).catch(function (error) {
                    console.log(error);
                });

            }
        },
        deleteProductAttribute(pa) {
            let _this = this;
            this.$swal({
                title: "Bạn có chắc không?",
                text: "Bạn không thể khôi phục thao tác này!",
                icon: "warning",
                buttons: true,
                showCancelButton: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    console.log(pa.id);
                    axios.post('/admin/products/attributes/delete', {
                        id: pa.id,
                    }).then(function (response) {
                        if (response.data.status === 'success') {
                            _this.$swal("Xóa thành công!", {
                                icon: "success",
                            });
                            _this.loadProductAttributes(_this.productid);
                        } else {
                            _this.$swal("Xóa thất bại!");
                        }
                    }).catch(function (error) {
                        console.log(error);
                    });
                } else {
                    // this.$swal("Action cancelled!");
                }
            });
        }

    }
}
</script>
