<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\Question;
use Illuminate\Console\Command;

class AddQuestions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add_questons {account_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '添加题库';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $account_id = trim($this->argument('account_id'));
        $account = Account::find($account_id);
        if (!$account)
            $this->info('无效的账号');
        $active = $account->activities()->first();
        $active->questions()->delete();
        $questions_list[1] = [
            [
                'title'   => '我国《民法通则与规定，多少周岁以上的公民是成年人?',
                'options' => [
                    '16',
                    '18',
                    '20',
                ],
                'answer'  => '2'
            ],
            [
                'title'   => '火药是哪个国家发明的?',
                'options' => [
                    '中国',
                    '日本',
                    '美国',
                ],
                'answer'  => '1'
            ],
            [
                'title'   => '一打"是指多少个?',
                'options' => [
                    '10',
                    '11',
                    '12',
                ],
                'answer'  => '3'
            ],
            [
                'title'   => '下列人物不是出自鲁迅文学作品的?',
                'options' => [
                    '鸣凤',
                    '祥林嫂',
                    '涓生',
                ],
                'answer'  => '1'
            ],
            [
                'title'   => '标志着新中国成立的历史事件?',
                'options' => [
                    '开国大典',
                    '土地改革的完成',
                    '第一届党代会的召开',
                ],
                'answer'  => '1'
            ],
            [
                'title'   => '酒精是哪种化学物质的俗称?',
                'options' => [
                    '甲醇',
                    '乙醇',
                    '甲醛',
                ],
                'answer'  => '2'
            ],
            [
                'title'   => '红豆生南国"这句话来源于哪首诗?',
                'options' => [
                    '《红豆》',
                    '《相思》',
                    '《赠别》',
                ],
                'answer'  => '2'
            ],
            [
                'title'   => '下列哪种物质能提升皮肤胶原蛋白及弹力素蛋白的合成能力?',
                'options' => [
                    '葡聚糖',
                    '灵芝三萜',
                    '有机锗',
                ],
                'answer'  => '1'
            ],
            [
                'title'   => '中国民间传说八仙过海中唯一一位女性是谁?',
                'options' => [
                    '李夫人',
                    '蓝采和',
                    '何仙姑',
                ],
                'answer'  => '3'
            ],
            [
                'title'   => '戛纳国际电影节邓在哪一个国家举办的?',
                'options' => [
                    '法国',
                    '美国',
                    '英国',
                ],
                'answer'  => '1'
            ],
        ];
        $questions_list[2] = [
            [
                'title'   => '有缘千里来相会，无缘对面手难牵"是哪首歌的歌词?',
                'options' => [
                    '《千年等一回与》',
                    '《新白娘子传奇》',
                    '《渡情》',
                ],
                'answer'  => '3'
            ],
            [
                'title'   => '鹿角灵芝的苦味来自那种物质?',
                'options' => [
                    '灵芝多糖',
                    '灵芝三萜',
                    '灵芝腺苷',
                ],
                'answer'  => '2'
            ],
            [
                'title'   => '韩国的首都是?',
                'options' => [
                    '釜山',
                    '仁川',
                    '首尔',
                ],
                'answer'  => '3'
            ],
            [
                'title'   => '正月十五是中国哪个传统节日?',
                'options' => [
                    '元宵节',
                    '中秋节',
                    '端午节',
                ],
                'answer'  => '1'
            ],
            [
                'title'   => '黄果树瀑布位于哪个省?',
                'options' => [
                    '贵州省',
                    '四川省',
                    '广西省',
                ],
                'answer'  => '1'
            ],
            [
                'title'   => '河北省的盛会是?',
                'options' => [
                    '石家庄',
                    '保定',
                    '承德',
                ],
                'answer'  => '1'
            ],
            [
                'title'   => '”鸡蛋仔"是哪个地区的传统街头小吃?',
                'options' => [
                    '广东',
                    '台湾',
                    '香港',
                ],
                'answer'  => '3'
            ],
            [
                'title'   => '市面上售卖的能有效提升免疫力的产品?',
                'options' => [
                    '魔爪',
                    '鹿角灵芝胶囊',
                    '脑白金',
                ],
                'answer'  => '2'
            ],
            [
                'title'   => '足球比赛里的村帽子戏法是什么意思?',
                'options' => [
                    '名球员单场进三球',
                    '球员带帽子比赛',
                    '换了三名替补',
                ],
                'answer'  => '1'
            ],
            [
                'title'   => '以下真菌中夕葡聚糖含量最高?',
                'options' => [
                    '野生灵芝',
                    '猪苓',
                    '鹿角灵芝',
                ],
                'answer'  => '3'
            ],

        ];
        $questions_list[3] = [
            [
                'title'   => '加重大的首都是?',
                'options' => [
                    '渥太华',
                    '温哥华',
                    '多伦多',
                ],
                'answer'  => '1'
            ],
            [
                'title'   => '收孙悟空为徒，并传授七十二变和筋斗云的是哪位神仙?',
                'options' => [
                    '菩提祖师',
                    '如来佛祖',
                    '唐僧',
                ],
                'answer'  => '2'
            ],
            [
                'title'   => '“嗟乎，大丈夫当如此也”是刘邦看到谁出行巡游时发出的感慨?',
                'options' => [
                    '项羽',
                    '秦始皇',
                    '陈胜吴广',
                ],
                'answer'  => '3'
            ],
            [
                'title'   => '横琴口岸是珠海通往哪座城市的口岸?',
                'options' => [
                    '香港',
                    '马来西亚',
                    '澳门',
                ],
                'answer'  => '3'
            ],
            [
                'title'   => ' 源于蒙古铁骑的战粮，被誉为“成吉思汗的行军粮”的是现在哪种零食?',
                'options' => [
                    '涮羊肉',
                    '牛肉干',
                    '马奶酒',
                ],
                'answer'  => '2'
            ],
            [
                'title'   => '三十六计中哪一计的名称描述了生物学上昆虫从蛹变为成虫的过程?',
                'options' => [
                    '鸡鸣狗盗',
                    '金蝉脱壳',
                    '欲擒故纵',
                ],
                'answer'  => '2'
            ],
            [
                'title'   => '1867年俄国以720万美元卖给美国的是哪个州',
                'options' => [
                    '阿拉斯加州',
                    '莫斯科',
                    '加利福尼亚州',
                ],
                'answer'  => '1'
            ],
            [
                'title'   => '中国篮球协会的现任主席是哪位名宿?',
                'options' => [
                    '姚明',
                    '刘翔',
                    '王治郅',
                ],
                'answer'  => '1'
            ],
            [
                'title'   => '根据提示猜出江苏省的一个城市：空中码头?',
                'options' => [
                    '舟山',
                    '连云港',
                    '南通',
                ],
                'answer'  => '2'
            ],
            [
                'title'   => '被出称为“森林医生”的是哪种鸟类?',
                'options' => [
                    '啄木鸟',
                    '乌鸦',
                    '喜鹊',
                ],
                'answer'  => '1'
            ],
        ];
        for ($j = 1; $j < 4; $j++) {
            $display_order = 1;
            $questions = $questions_list[$j];
            foreach ($questions as $item) {
                $question = new Question();
                $question->active_id = $active->id;
                $question->round_number = $j;
                $question->status = 1;
                $question->title = '第' . $display_order . "题：" . $item['title'];
                $question->options = $item['options'];
                $question->answer = $item['answer'];
                $question->score = 0;
                $question->display_order = $display_order;
                $question->save();
                $this->info('初始化第' . $j . '轮第' . $display_order . '题完毕');
                $display_order++;
            }
            $this->info('初始化第' . $j . '轮所有题木目完毕');
        }
    }
}
