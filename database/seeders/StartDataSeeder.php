<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StartDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'administrator',
                'description' => 'administrator of the system',
            ],
            [
                'name' => 'author',
                'description' => 'author, able to create and edit its own posts',
            ]
        ];

        Role::insert($roles);

        $admin = User::create([
            'name' => 'administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('sgdevsgdev'),
        ]);

        $author = User::create([
            'name' => 'author',
            'email' => 'author@author.com',
            'password' => Hash::make('sgdevsgdev'),
        ]);

        $admin->roles()->attach(1);
        $author->roles()->attach(2);

        $categories = [
            ['name' => 'Technology', 'slug' => Str::slug('Technology'), 'description' => 'Posts about the latest in technology, gadgets, and software.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Programming', 'slug' => Str::slug('Programming'), 'description' => 'Articles related to coding and programming tutorials.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Health & Wellness', 'slug' => Str::slug('Health & Wellness'), 'description' => 'Tips and advice for a healthy lifestyle.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Fitness', 'slug' => Str::slug('Fitness'), 'description' => 'Posts about workouts, fitness tips, and maintaining health.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Business', 'slug' => Str::slug('Business'), 'description' => 'Posts on entrepreneurship, business strategies, and market trends.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Finance', 'slug' => Str::slug('Finance'), 'description' => 'Tips on personal finance, investing, and money management.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Self Improvement', 'slug' => Str::slug('Self Improvement'), 'description' => 'Guides on productivity, personal growth, and self-care.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Career Development', 'slug' => Str::slug('Career Development'), 'description' => 'Advice on career paths, job skills, and professional growth.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Education', 'slug' => Str::slug('Education'), 'description' => 'Articles on learning, teaching, and educational tools.', 'parent_id' => null, 'user_id' => $author->id],
            ['name' => 'Science', 'slug' => Str::slug('Science'), 'description' => 'Discoveries and research in various scientific fields.', 'parent_id' => null, 'user_id' => $author->id],
            ['name' => 'Environment', 'slug' => Str::slug('Environment'), 'description' => 'Posts on sustainability, climate change, and green living.', 'parent_id' => null, 'user_id' => $author->id],
            ['name' => 'Travel', 'slug' => Str::slug('Travel'), 'description' => 'Guides and tips for travelers and adventurers.', 'parent_id' => null, 'user_id' => $author->id],
            ['name' => 'Photography', 'slug' => Str::slug('Photography'), 'description' => 'Techniques, tips, and stories about photography.', 'parent_id' => null, 'user_id' => $author->id],
            ['name' => 'Gaming', 'slug' => Str::slug('Gaming'), 'description' => 'Reviews, news, and articles about gaming culture.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Music', 'slug' => Str::slug('Music'), 'description' => 'Articles about music genres, artists, and the music industry.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Movies', 'slug' => Str::slug('Movies'), 'description' => 'Reviews, news, and critiques of movies and cinema.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Books', 'slug' => Str::slug('Books'), 'description' => 'Recommendations and reviews of popular books.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Fashion', 'slug' => Str::slug('Fashion'), 'description' => 'Posts on fashion trends, styles, and the industry.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Beauty', 'slug' => Str::slug('Beauty'), 'description' => 'Advice on skincare, makeup, and beauty tips.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Cooking', 'slug' => Str::slug('Cooking'), 'description' => 'Recipes, cooking techniques, and food culture.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Parenting', 'slug' => Str::slug('Parenting'), 'description' => 'Tips and advice for parents.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Relationships', 'slug' => Str::slug('Relationships'), 'description' => 'Advice on relationships, dating, and family matters.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Pets', 'slug' => Str::slug('Pets'), 'description' => 'Articles about pet care, behavior, and health.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Art', 'slug' => Str::slug('Art'), 'description' => 'Posts on various forms of art, creativity, and artistic expression.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Home Improvement', 'slug' => Str::slug('Home Improvement'), 'description' => 'DIY tips and advice for improving and maintaining homes.', 'parent_id' => null, 'user_id' => $author->id],
            ['name' => 'Automotive', 'slug' => Str::slug('Automotive'), 'description' => 'News and advice about cars, maintenance, and driving.', 'parent_id' => null, 'user_id' => $author->id],
            ['name' => 'Outdoors', 'slug' => Str::slug('Outdoors'), 'description' => 'Posts about outdoor activities, adventures, and nature.', 'parent_id' => null, 'user_id' => $author->id],
            ['name' => 'Politics', 'slug' => Str::slug('Politics'), 'description' => 'Opinions and articles on politics and government.', 'parent_id' => null, 'user_id' => $author->id],
            ['name' => 'History', 'slug' => Str::slug('History'), 'description' => 'Articles and essays about historical events and figures.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Psychology', 'slug' => Str::slug('Psychology'), 'description' => 'Posts on mental health, psychology, and human behavior.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Spirituality', 'slug' => Str::slug('Spirituality'), 'description' => 'Articles on religion, faith, and spiritual practices.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Philosophy', 'slug' => Str::slug('Philosophy'), 'description' => 'Philosophical discussions, theories, and ideas.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Gardening', 'slug' => Str::slug('Gardening'), 'description' => 'Tips and advice for gardening and plant care.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Crafts', 'slug' => Str::slug('Crafts'), 'description' => 'Posts on DIY projects, crafts, and handmade creations.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Food & Drink', 'slug' => Str::slug('Food & Drink'), 'description' => 'Posts about food culture, recipes, and dining experiences.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Photography', 'slug' => Str::slug('Photography'), 'description' => 'Articles and guides for aspiring and professional photographers.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Tech News', 'slug' => Str::slug('Tech News'), 'description' => 'Updates and analysis of the latest technology trends.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Hiking', 'slug' => Str::slug('Hiking'), 'description' => 'Guides and tips for hikers and outdoor adventurers.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Productivity', 'slug' => Str::slug('Productivity'), 'description' => 'Tips and tools to boost productivity and manage time.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Architecture', 'slug' => Str::slug('Architecture'), 'description' => 'Posts on architectural design, history, and styles.', 'parent_id' => null, 'user_id' => $author->id],
            ['name' => 'Luxury Lifestyle', 'slug' => Str::slug('Luxury Lifestyle'), 'description' => 'Articles on luxury brands, products, and experiences.', 'parent_id' => null, 'user_id' => $author->id],
            ['name' => 'Politics & Government', 'slug' => Str::slug('Politics & Government'), 'description' => 'Articles and opinions on political news and governance.', 'parent_id' => null, 'user_id' => $admin->id],
            ['name' => 'Science Fiction', 'slug' => Str::slug('Science Fiction'), 'description' => 'Discussions and stories about science fiction genres.', 'parent_id' => null, 'user_id' => $admin->id],
        ];

        Category::insert($categories);

        $tags = [
            ['name' => 'Laravel', 'slug' => Str::slug('Laravel'), 'description' => 'Posts related to the Laravel PHP framework.', 'user_id' => $admin->id],
            ['name' => 'JavaScript', 'slug' => Str::slug('JavaScript'), 'description' => 'All things related to JavaScript programming.', 'user_id' => $admin->id],
            ['name' => 'Vue.js', 'slug' => Str::slug('Vue.js'), 'description' => 'Content about the Vue.js JavaScript framework.', 'user_id' => $admin->id],
            ['name' => 'Web Development', 'slug' => Str::slug('Web Development'), 'description' => 'Posts focused on web development practices and technologies.', 'user_id' => $admin->id],
            ['name' => 'React', 'slug' => Str::slug('React'), 'description' => 'Posts related to the React JavaScript library.', 'user_id' => $admin->id],
            ['name' => 'PHP', 'slug' => Str::slug('PHP'), 'description' => 'Articles about PHP and back-end development.', 'user_id' => $admin->id],
            ['name' => 'CSS', 'slug' => Str::slug('CSS'), 'description' => 'Tips and tutorials on CSS and styling.', 'user_id' => $admin->id],
            ['name' => 'Tailwind CSS', 'slug' => Str::slug('Tailwind CSS'), 'description' => 'Posts about the Tailwind CSS framework.', 'user_id' => $admin->id],
            ['name' => 'Node.js', 'slug' => Str::slug('Node.js'), 'description' => 'Content about Node.js and server-side JavaScript.', 'user_id' => $admin->id],
            ['name' => 'Python', 'slug' => Str::slug('Python'), 'description' => 'Articles on Python programming and applications.', 'user_id' => $author->id], // 1
            ['name' => 'Data Science', 'slug' => Str::slug('Data Science'), 'description' => 'Posts about data science, machine learning, and AI.', 'user_id' => $author->id], // 2
            ['name' => 'Machine Learning', 'slug' => Str::slug('Machine Learning'), 'description' => 'Articles related to machine learning algorithms.', 'user_id' => $author->id], // 3
            ['name' => 'Cybersecurity', 'slug' => Str::slug('Cybersecurity'), 'description' => 'Posts about digital security and data protection.', 'user_id' => $author->id], // 4
            ['name' => 'Blockchain', 'slug' => Str::slug('Blockchain'), 'description' => 'Posts exploring blockchain technology.', 'user_id' => $author->id], // 5
            ['name' => 'Cryptocurrency', 'slug' => Str::slug('Cryptocurrency'), 'description' => 'Content on cryptocurrency news and trends.', 'user_id' => $author->id], // 6
            ['name' => 'DevOps', 'slug' => Str::slug('DevOps'), 'description' => 'Articles about development operations and automation.', 'user_id' => $author->id], // 7
            ['name' => 'Cloud Computing', 'slug' => Str::slug('Cloud Computing'), 'description' => 'Posts about cloud services and platforms.', 'user_id' => $author->id], // 8
            ['name' => 'Docker', 'slug' => Str::slug('Docker'), 'description' => 'Guides and tutorials on Docker and containerization.', 'user_id' => $author->id], // 9
            ['name' => 'Kubernetes', 'slug' => Str::slug('Kubernetes'), 'description' => 'Posts about Kubernetes orchestration.', 'user_id' => $author->id], // 10
            ['name' => 'API Development', 'slug' => Str::slug('API Development'), 'description' => 'Guides on building and using APIs.', 'user_id' => $admin->id],
            ['name' => 'UI/UX Design', 'slug' => Str::slug('UI/UX Design'), 'description' => 'Posts about user interface and user experience design.', 'user_id' => $admin->id],
            ['name' => 'SEO', 'slug' => Str::slug('SEO'), 'description' => 'Tips for improving search engine optimization.', 'user_id' => $admin->id],
            ['name' => 'Digital Marketing', 'slug' => Str::slug('Digital Marketing'), 'description' => 'Posts on online marketing strategies and tools.', 'user_id' => $admin->id],
            ['name' => 'E-commerce', 'slug' => Str::slug('E-commerce'), 'description' => 'Articles about online selling and e-commerce platforms.', 'user_id' => $admin->id],
            ['name' => 'Git', 'slug' => Str::slug('Git'), 'description' => 'Posts on version control using Git and GitHub.', 'user_id' => $admin->id],
            ['name' => 'Mobile Development', 'slug' => Str::slug('Mobile Development'), 'description' => 'Content on building apps for mobile platforms.', 'user_id' => $admin->id],
            ['name' => 'SaaS', 'slug' => Str::slug('SaaS'), 'description' => 'Posts on Software as a Service business models.', 'user_id' => $admin->id],
            ['name' => 'Agile Methodology', 'slug' => Str::slug('Agile Methodology'), 'description' => 'Posts about Agile project management practices.', 'user_id' => $admin->id],
            ['name' => 'Testing', 'slug' => Str::slug('Testing'), 'description' => 'Articles on software testing and QA best practices.', 'user_id' => $admin->id],
            ['name' => 'Microservices', 'slug' => Str::slug('Microservices'), 'description' => 'Posts about building and managing microservices.', 'user_id' => $admin->id],
        ];

        Tag::insert($tags);

        for ($i = 0; $i < 50; $i++) {
            $title = fake()->realText(mt_rand(10, 30));
            $user_id = mt_rand(1, 2);
            $post = Post::create([
                'user_id' => $user_id,
                'title' => $title,
                'banner' => fake()->imageUrl(),
                'content' => fake()->realTextBetween(mt_rand(500, 5000), mt_rand(5000, 10000)),
                'status' => Arr::random(['published', 'draft'], 1)[0],
                'slug' => Str::slug($title),
                'short_description' => fake()->realText(),
            ]);

            $categoryIds = Category::where('user_id', $user_id)->pluck('id')->toArray();
            $tagIds = Tag::where('user_id', $user_id)->pluck('id')->toArray();

            $postCategories = Arr::random($categoryIds, rand(1, 10));
            $post->categories()->sync($postCategories);
            $postTags = Arr::random($tagIds, rand(2, 8));
            $post->tags()->sync($postTags);
        }
    }
}
