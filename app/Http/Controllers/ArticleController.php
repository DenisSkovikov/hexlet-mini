<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->input('q');
        /*
        if($q == ""){
            $articles = Article::paginate(3);
        }else{
            $articles = Article::where('name', 'like', "%{$q}%")->get();
        }
        */
        $articles = Article::where('name', 'like', "%{$q}%")->paginate(6);

        // Статьи передаются в шаблон
        // compact('articles') => [ 'articles' => $articles ]
        //return view('article.index', compact('articles'));
        
        

        // BEGIN (write your solution here)
        /*
        $params = [
            'q' => [
                'email' => 'lala@ehu.com',
                'first_name' => 'Mike'
            ],
            's' => 'id:desc'
        ];
        $query = User::query();
        if (isset($params['q'])) {
            foreach ($params['q'] as $k => $item) {
                $query->orWhere($k, '=', $item);
            }
        }
        if (isset($params['s'])) {
            $exp = explode(":", $params['s']);
            $query->orderBy($exp[0], $exp[1]);
        }
        print_r($query->toSql());
        //exit();
        //return $query->get();
        */
        // END
    
        
        
        
        
        
        return view('article.index', ['articles' => $articles, 'q' => $q]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Передаем в шаблон вновь созданный объект. Он нужен для вывода формы через Form::model
        $article = new Article();
        return view('article.create', compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        // Проверка введенных данных
        // Если будут ошибки, то возникнет исключение
        // Иначе возвращаются данные формы
        /*
        $data = $this->validate($request, [
            'name' => 'required|unique:articles',
            'body' => 'required|min:20',
        ]);
        */
        // Получить проверенные входные данные...
        $data = $request->validated();
        
        $article = new Article();
        // Заполнение статьи данными из формы
        $article->fill($data);
        // При ошибках сохранения возникнет исключение
        $article->save();
        
        $request->session()->flash('success', 'Статья успешно добавлена!');
        
        // Редирект на указанный маршрут
        return redirect()
            ->route('articles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //$article = Article::findOrFail($id);
        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //$article = Article::findOrFail($id);
        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        //$article = Article::findOrFail($id);
        
        // Получить проверенные входные данные...
        $data = $request->validated();
        /*
        $data = $this->validate($request, [
            // У обновления немного измененная валидация. В проверку уникальности добавляется название поля и id текущего объекта
            // Если этого не сделать, Laravel будет ругаться на то что имя уже существует
            'name' => 'required|unique:articles,name,' . $article->id,
            'body' => 'required|min:100',
        ]);
        */
        $article->fill($data);
        $article->save();
        
        $request->session()->flash('success', 'Статья успешно изменена!');
        
        return redirect()
            ->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article, Request $request)
    {
        // DELETE — идемпотентный метод, поэтому результат операции всегда один и тот же
        //$article = Article::find($id);
        if ($article) {
            
            $request->session()->flash('success', 'Статья успешно удалена!');
            $article->delete();
        }
        return redirect()->route('articles.index');
    }
}
