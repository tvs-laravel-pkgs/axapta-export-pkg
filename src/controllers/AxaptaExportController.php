<?php

namespace Abs\AxaptaExportPkg;
use Abs\AxaptaExportPkg\AxaptaExport;
use App\Address;
use App\Country;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Validator;
use Yajra\Datatables\Datatables;

class AxaptaExportController extends Controller {

	public function __construct() {
	}

	public function getAxaptaExportList(Request $request) {
		$axapta-export_list = AxaptaExport::withTrashed()
			->select(
				'axapta-exports.id',
				'axapta-exports.code',
				'axapta-exports.name',
				'axapta-exports.mobile_no',
				'axapta-exports.email',
				DB::raw('IF(axapta-exports.deleted_at IS NULL,"Active","Inactive") as status')
			)
			->where('axapta-exports.company_id', Auth::user()->company_id)
			->where(function ($query) use ($request) {
				if (!empty($request->axapta-export_code)) {
					$query->where('axapta-exports.code', 'LIKE', '%' . $request->axapta-export_code . '%');
				}
			})
			->where(function ($query) use ($request) {
				if (!empty($request->axapta-export_name)) {
					$query->where('axapta-exports.name', 'LIKE', '%' . $request->axapta-export_name . '%');
				}
			})
			->where(function ($query) use ($request) {
				if (!empty($request->mobile_no)) {
					$query->where('axapta-exports.mobile_no', 'LIKE', '%' . $request->mobile_no . '%');
				}
			})
			->where(function ($query) use ($request) {
				if (!empty($request->email)) {
					$query->where('axapta-exports.email', 'LIKE', '%' . $request->email . '%');
				}
			})
			->orderby('axapta-exports.id', 'desc');

		return Datatables::of($axapta-export_list)
			->addColumn('code', function ($axapta-export_list) {
				$status = $axapta-export_list->status == 'Active' ? 'green' : 'red';
				return '<span class="status-indicator ' . $status . '"></span>' . $axapta-export_list->code;
			})
			->addColumn('action', function ($axapta-export_list) {
				$edit_img = asset('public/theme/img/table/cndn/edit.svg');
				$delete_img = asset('public/theme/img/table/cndn/delete.svg');
				return '
					<a href="#!/axapta-export-pkg/axapta-export/edit/' . $axapta-export_list->id . '">
						<img src="' . $edit_img . '" alt="View" class="img-responsive">
					</a>
					<a href="javascript:;" data-toggle="modal" data-target="#delete_axapta-export"
					onclick="angular.element(this).scope().deleteAxaptaExport(' . $axapta-export_list->id . ')" dusk = "delete-btn" title="Delete">
					<img src="' . $delete_img . '" alt="delete" class="img-responsive">
					</a>
					';
			})
			->make(true);
	}

	public function getAxaptaExportFormData($id = NULL) {
		if (!$id) {
			$axapta-export = new AxaptaExport;
			$address = new Address;
			$action = 'Add';
		} else {
			$axapta-export = AxaptaExport::withTrashed()->find($id);
			$address = Address::where('address_of_id', 24)->where('entity_id', $id)->first();
			$action = 'Edit';
		}
		$this->data['country_list'] = $country_list = Collect(Country::select('id', 'name')->get())->prepend(['id' => '', 'name' => 'Select Country']);
		$this->data['axapta-export'] = $axapta-export;
		$this->data['address'] = $address;
		$this->data['action'] = $action;

		return response()->json($this->data);
	}

	public function saveAxaptaExport(Request $request) {
		// dd($request->all());
		try {
			$error_messages = [
				'code.required' => 'AxaptaExport Code is Required',
				'code.max' => 'Maximum 255 Characters',
				'code.min' => 'Minimum 3 Characters',
				'name.required' => 'AxaptaExport Name is Required',
				'name.max' => 'Maximum 255 Characters',
				'name.min' => 'Minimum 3 Characters',
				'mobile_no.required' => 'Mobile Number is Required',
				'mobile_no.max' => 'Maximum 25 Numbers',
				'email.required' => 'Email is Required',
				'address_line1.required' => 'Address Line 1 is Required',
				'address_line1.max' => 'Maximum 255 Characters',
				'address_line1.min' => 'Minimum 3 Characters',
				'address_line2.max' => 'Maximum 255 Characters',
				'pincode.required' => 'Pincode is Required',
				'pincode.max' => 'Maximum 6 Characters',
				'pincode.min' => 'Minimum 6 Characters',
			];
			$validator = Validator::make($request->all(), [
				'code' => 'required|max:255|min:3',
				'name' => 'required|max:255|min:3',
				'mobile_no' => 'required|max:25',
				'email' => 'required',
				'address_line1' => 'required|max:255|min:3',
				'address_line2' => 'max:255',
				'pincode' => 'required|max:6|min:6',
			], $error_messages);
			if ($validator->fails()) {
				return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
			}

			DB::beginTransaction();
			if (!$request->id) {
				$axapta-export = new AxaptaExport;
				$axapta-export->created_by_id = Auth::user()->id;
				$axapta-export->created_at = Carbon::now();
				$axapta-export->updated_at = NULL;
				$address = new Address;
			} else {
				$axapta-export = AxaptaExport::withTrashed()->find($request->id);
				$axapta-export->updated_by_id = Auth::user()->id;
				$axapta-export->updated_at = Carbon::now();
				$address = Address::where('address_of_id', 24)->where('entity_id', $request->id)->first();
			}
			$axapta-export->fill($request->all());
			$axapta-export->company_id = Auth::user()->company_id;
			if ($request->status == 'Inactive') {
				$axapta-export->deleted_at = Carbon::now();
				$axapta-export->deleted_by_id = Auth::user()->id;
			} else {
				$axapta-export->deleted_by_id = NULL;
				$axapta-export->deleted_at = NULL;
			}
			$axapta-export->save();

			if (!$address) {
				$address = new Address;

			}
			$address->fill($request->all());
			$address->company_id = Auth::user()->company_id;
			$address->address_of_id = 24;
			$address->entity_id = $axapta-export->id;
			$address->address_type_id = 40;
			$address->name = 'Primary Address';
			$address->save();

			DB::commit();
			if (!($request->id)) {
				return response()->json(['success' => true, 'message' => ['AxaptaExport Details Added Successfully']]);
			} else {
				return response()->json(['success' => true, 'message' => ['AxaptaExport Details Updated Successfully']]);
			}
		} catch (Exceprion $e) {
			DB::rollBack();
			return response()->json(['success' => false, 'errors' => ['Exception Error' => $e->getMessage()]]);
		}
	}
	public function deleteAxaptaExport($id) {
		$delete_status = AxaptaExport::withTrashed()->where('id', $id)->forceDelete();
		if ($delete_status) {
			$address_delete = Address::where('address_of_id', 24)->where('entity_id', $id)->forceDelete();
			return response()->json(['success' => true]);
		}
	}
}
