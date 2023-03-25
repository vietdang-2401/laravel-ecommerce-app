<template>
	<div id="">
		<div class="tile">
			<h3 class="tile-title">Giá trị thuộc tính</h3>
			<hr>
			<div class="tile-body">
				<div class="form-group">
					<label class="control-label" for="value">Giá trị</label>
					<input class="form-control" type="text" placeholder="Nhập giá trị thuộc tính" id="value" name="value"
						v-model="value" />
				</div>
				<div class="form-group">
					<label class="control-label" for="price">Giá</label>
					<input class="form-control" type="number" placeholder="Nhập giá" id="price" name="price"
						v-model="price" />
				</div>
			</div>
			<div class="tile-footer">
				<div class="row d-print-none mt-2">
					<div class="col-12 text-right">
						<button class="btn btn-success" type="submit" @click.stop="saveValue()" v-if="addValue">
							<i class="fa fa-fw fa-lg fa-check-circle"></i>Lưu
						</button>
						<button class="btn btn-success" type="submit" @click.stop="updateValue()" v-if="!addValue">
							<i class="fa fa-fw fa-lg fa-check-circle"></i>Cập nhật
						</button>
						<button class="btn btn-primary" type="submit" @click.stop="reset()" v-if="!addValue">
							<i class="fa fa-fw fa-lg fa-check-circle"></i>Đặt lại
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="tile">
			<h3 class="tile-title">Giá trị lựa chọn</h3>
			<div class="tile-body">
				<div class="table-responsive">
					<table class="table table-sm">
						<thead>
							<tr class="text-center">
								<th>#</th>
								<th>Giá trị</th>
								<th>Giá</th>
								<th>Hành động</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="value in values">
								<td style="width: 25%" class="text-center">{{ value.id }}</td>
								<td style="width: 25%" class="text-center">{{ value.value }}</td>
								<td style="width: 25%" class="text-center">{{ value.price }}₫</td>
								<td style="width: 25%" class="text-center">
									<button class="btn btn-sm btn-primary" @click.stop="editAttributeValue(value)">
										<i class="fa fa-edit"></i>
									</button>
									<button class="btn btn-sm btn-danger" @click.stop="deleteAttributeValue(value)">
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
	name: "attribute-values",
	props: ['attributeid'],
	data() {
		return {
			values: [],
			value: '',
			price: '',
			currentId: '',
			addValue: true,
			key: 0,
		}
	},
	created: function () {
		this.loadValues();
	},
	methods: {
		loadValues() {
			let attributeId = this.attributeid;
			let _this = this;
			axios.post('/admin/attributes/get-values', {
				id: attributeId
			}).then(function (response) {
				_this.values = response.data;
			}).catch(function (error) {
				console.log(error);
			});
		},
		saveValue() {
			if (this.value === '') {
				this.$swal("Giá trị cho thuộc tính là bắt buộc.", {
					icon: "error",
				});
			} else {
				let attributeId = this.attributeid;
				let _this = this;
				axios.post('/admin/attributes/add-values', {
					id: attributeId,
					value: _this.value,
					price: _this.price,
				}).then(function (response) {
					_this.values.push(response.data);
					_this.resetValue();
					_this.$swal("Thêm giá trị thành công!", {
						icon: "success",
					});
				}).catch(function (error) {
					console.log(error);
				});
			}
		},
		resetValue() {
			this.value = '';
			this.price = '';
		},
		reset() {
			this.addValue = true;
			this.resetValue();
		},
		editAttributeValue(value) {
			this.addValue = false;
			this.value = value.value;
			this.price = value.price;
			this.currentId = value.id;
			this.key = this.values.indexOf(value);
		},
		updateValue() {
			if (this.value === '') {
				this.$swal("Giá trị cho thuộc tính là bắt buộc.", {
					icon: "error",
				});
			} else {
				let attributeId = this.attributeid;
				let _this = this;
				console.log(_this.currentId, _this.price, _this.value, attributeId);
				axios.post('/admin/attributes/update-values', {
					id: attributeId,
					value: _this.value,
					price: _this.price,
					valueId: _this.currentId
				}).then(function (response) {
					_this.values.splice(_this.key, 1);
					_this.reset();
					_this.values.push(response.data);
					_this.$swal("Cập nhật thành công!", {
						icon: "success",
					});
				}).catch(function (error) {
					console.log(error);
				});
			}
		},

		deleteAttributeValue(value) {
			this.$swal({
				title: "Bạn có chắc không?",
				text: "Bạn không thể khôi phục thao tác này!",
				icon: "warning",
				buttons: true,
				showCancelButton: true,
				dangerMode: true,
			}).then((result) => {
				if (result.isConfirmed) {
					this.currentId = value.id;
					this.key = this.values.indexOf(value);
					let _this = this;
					axios.post('/admin/attributes/delete-values', {
						id: _this.currentId
					}).then(function (response) {
						if (response.data.status === 'success') {
							_this.values.splice(_this.key, 1);
							_this.resetValue();
							_this.$swal("Xóa giá trị thành công!", {
								icon: "success",
							});
						} else {
							_this.$swal("Có lỗi xảy ra trong quá trình xóa giá trị!");
						}
					}).catch(function (error) {
						console.log(error);
					});
				} else {
					// this.$swal("Your option value not deleted!");
				}
			});
		},

	}
}

</script>