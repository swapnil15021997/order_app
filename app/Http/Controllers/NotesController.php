<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notes;
use App\Models\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class NotesController extends Controller
{
    //

    public function add_notes(Request $request){
        $params = $request->all();
        \Log::info(['params'=>$params]);
        if ($request->hasFile('notes_file')) {
            $file = $request->file('notes_file')[0]; // Assuming it's an array of files
            \Log::info('Uploaded File MIME Type: ' . $file->getMimeType());
            \Log::info('Uploaded File Extension: ' . $file->getClientOriginalExtension());
        }
        $rules = [   
            'notes_text'          => ['nullable','string'],
            'notes_file'          => ['nullable'],  
            'notes_file.*'        => ['file', 'mimes:jpeg,jpg,png,pdf,mp3,wav,ogg', 'max:20240'],  
            'notes_file.*.mime' => 'in:audio/wav,mp3,ogg',
            'notes_order_id'      => ['nullable','string'],
            'notes_type'          => ['required','string'],
            
        ]; 
        $messages = [
            'notes_text.string'     => 'Please provide valid string in notes text.',
            'notes_file.array'      => 'Item file images must be an array.',
            'notes_file.*.file'     => 'Each item file image must be a valid file.',
            'notes_file.*.mimes'    => 'Each item file image must be a jpeg, jpg, png, or pdf file,mp3, wav, or ogg file.',
            'notes_file.*.max'      => 'Each item file image cannot exceed 10MB.',
            'notes_order_id.string'     => 'Notes id must be string.',
            'notes_order_id.required'   => 'Notes order required.',
            'notes_type.string'     => 'Notes Type must be string.',
            'notes_type.required'   => 'Notes Type required.',
    
        ]; 
        $validator = Validator::make($params, $rules, $messages);
        
        if($validator->fails()){
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0], 
                'errors'  => $validator->errors(), 
            ]);
        } 
        
        $notes_save = new Notes();
        $notes_save->notes_text = $params['notes_text'];
        $notes_save->notes_type = $params['notes_type'];
        $notes_save->notes_order_id = $params['notes_order_id'];
        $fileIds = [];

        if ($request->hasFile('notes_file')) {
            $files = $request->file('notes_file');
            \Log::info('Files uploaded: ' . count($files));
            foreach ($files as $file) {
                $filePath = $file->store('uploads', 'public'); 
                $fileModel = new File();
                $fileModel->file_name = $file->hashName(); 
                $fileModel->file_original_name = $file->getClientOriginalName();
                $fileModel->file_path = $filePath;
                $fileModel->file_url = asset('storage/' . $filePath); 
                $fileModel->file_type = $file->getClientMimeType();
                $fileModel->file_size = $file->getSize();
                $fileModel->save();
                $fileIds[] = $fileModel->file_id;
    
            }
            $notes_save->notes_file_id = implode(',', $fileIds);
            
        }
        $notes_save->save();

        return response()->json([
            'status'  => 200,
            'message' => 'Notes saved successfully',
            'data'  => $notes_save->notes_id
        ]);
    }



    public function notes_details(Request $request){
        $params = $request->all();
        $rules = [   
            'notes_id'          => ['required','string'],
           
        ]; 
        $messages = [
            'notes_id.string'        => 'Please provide valid string in notes id.',
            'notes_id.required'      => 'Please provide notes id.'
        ]; 
        $validator = Validator::make($params, $rules, $messages);
        
        if($validator->fails()){
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0], 
                'errors'  => $validator->errors(), 
            ]);
        } 

        $notes = Notes::get_notes_by_id($params['notes_id']);
        if(empty($notes)){
            return response()->json([
                'status'  => 500,
                'message' => 'Notes does not found'
            ]);
        }

        return response()->json([
            'status'  => 200,
            'message' => 'Notes fetched successfully', 
            'data'    => $notes 
        ]);
    }


    public function notes_remove(Request $request){
        $params = $request->all();
        $rules = [   
            'notes_id'          => ['required','string'],
           
        ]; 
        $messages = [
            'notes_id.string'        => 'Please provide valid string in notes id.',
            'notes_id.required'      => 'Please provide notes id.'
        ]; 
        $validator = Validator::make($params, $rules, $messages);
        
        if($validator->fails()){
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0], 
                'errors'  => $validator->errors(), 
            ]);
        } 

        $notes = Notes::get_notes_by_id($params['notes_id']);
        if(empty($notes)){
            return response()->json([
                'status'  => 500,
                'message' => 'Notes does not found'
            ]);
        }

        $notes->is_delete = 1;
        $notes->save();
        return response()->json([
            'status'  => 200,
            'message' => 'Notes removed successfully'
        ]);
    }




    public function notes_list(Request $request){
        $rules = [
            'search'   => ['nullable', 'string'], 
            'per_page' => ['nullable', 'integer', 'min:1'], 
            'page'     => ['nullable', 'integer', 'min:1'], 
        ];
    
        $messages = [
            'search.string'   => 'Search query must be a valid string.',
            'per_page.integer' => 'Items per page must be a valid integer.',
            'per_page.min'     => 'Items per page must be at least 1.',
            'page.integer'     => 'Page number must be a valid integer.',
            'page.min'         => 'Page number must be at least 1.',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0],
                'errors'  => $validator->errors(),
            ]);
        }
        $searchQuery = $request->input('search', ''); 
        $perPage     = $request->input('per_page', 15);   
        $page        = $request->input('page', 1);  
        $order_id    = $request->input('order_id');  
        $offset      = ($page - 1) * $perPage;
        if(empty($order_id)){
            return response()->json([
                'status' => 200,
                'message' => 'Notes list fetched successfully!',
                'data'    => []
                ]);    
        }
  
        $notesQuery  = Notes::query()->with('file');       
        if (!empty($searchQuery)) {
            $notesQuery->where(function ($query) use ($searchQuery) {
                $query->where('notes_text', 'like', "%{$searchQuery}%");
            });
        }
        
        $total_notes = $notesQuery->count();
        $notes = $notesQuery
            ->where('notes_order_id',$order_id)
            ->offset($offset)
            ->limit($perPage)
            
            ->get();
        $total_pages = ceil($total_notes / $perPage);
        
        return response()->json([
            'status' => 200,
            'message' => 'Notes list fetched successfully!',
            'data'    => [
                'notes'        => $notes,
                'total'        => $total_notes,
                'per_page'     => $perPage,
                'current_page' => $page,
                'total_pages'  => $total_pages,
            ],
        ]);
    }
}
