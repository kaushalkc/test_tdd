<?php

namespace App\Http\Controllers;
use App\Models\TodoList;
// use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;



class TodoListController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/todo-list/",
     *     tags={"todo-list"},
     *     summary="Get all todo list",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="index",
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Status values that needed to be considered for filter",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             default="available",
     *             type="string",
     *             enum={"available", "pending", "sold"},
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
     */

    public function index(){
        $lists = TodoList::all();
        return response($lists);
    }

    /**
     * @OA\Get(
     *      path="/api/todo-list/{todo_list}",
     *      operationId="getById",
     *      tags={"todo-list"},
     *      summary="Get related list details by id",
     *      description="Returns related todo list details",
     *      @OA\Parameter(name="todo_list", in="path", description="todo-list id", required=true,
     *          @OA\Schema(type="integer",),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object"
     *          )
     *       )
     *  )
     */

    public function show(TodoList $todo_list)
    {
        return response($todo_list);
    }

    /**
     * @OA\Post(
     *      path="/api/todo-list/",
     *      operationId="post",
     *      tags={"todo-list"},
     *      summary="post todo list",
     *      security= {{"Bearer_auth": ""}},
     *      description="post todo list",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", format="string", example="xyz"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *          @OA\JsonContent(
     *              type="object",
     *              description="Fields validation",
     *              example={
     *                  "error"="error",
     *                  "status_code"=422,
     *                  "message"="Fields Validation Failed.",
     *                  "payload"={
     *                      "cc_number"={"Invalid credit card number."}
     *                  }
     *              }
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              description="success message",
     *              example={
     *                  "status_code"=200,
     *                  "message"="Order has been placed successfully.",
     *                  "payload"={}
     *              }
     *          )
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request error.",
     *          @OA\JsonContent(
     *              type="object",
     *              description="Bad request error.",
     *              example={
     *                  "error"="error",
     *                  "status_code"=400,
     *                  "message"="Something went wrong on the server."
     *              }
     *          )
     *      ),
     *    )
     */

    public function store(Request $request)
    {
        return TodoList::create($request->all());
        
    }

    /**
     * @OA\Delete(
     *      path="/api/todo-list/{todo_list}",
     *      operationId="delete",
     *      tags={"todo-list"},
     *      summary="Delete todo list",
     *      security= {{"Bearer_auth": ""}},
     *      description="Delete files on cart",
     *      @OA\Parameter(name="todo_list", in="path", description="file id", required=true,
     *          @OA\Schema(type="integer",),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              description="success message",
     *              example={
     *                  "status_code"=200,
     *                  "message"="todo list has been deleted successfully",
     *                  "payload"={
     *                  }
     *              }
     *          )
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request error.",
     *          @OA\JsonContent(
     *              type="object",
     *              description="Bad request error.",
     *              example={
     *                  "error"="error",
     *                  "status_code"=400,
     *                  "message"="Something went wrong on the server."
     *              }
     *          )
     *      ),
     *    )
     */


    public function destroy(TodoList $todo_list)
    {
        $todo_list->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }


    /**
     * @OA\Put(
     *     path="/api/todo-list/{todo_list}",
     *     operationId="update",
     *     tags={"todo-list"},
     *     summary="Update article in DB",
     *     description="Update article in DB",
     *     @OA\Parameter(name="todo_list", in="path", description="Id of todo list", required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(
     *           required={"name"},
     *           @OA\Property(property="name", type="string", format="string", example="update todo list"),
     *        ),
     *     ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status_code", type="integer", example="200"),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */

    public function update(Request $request, TodoList $todo_list)
    {
        $todo_list->update($request->all());
        return response($todo_list);
    }
}
