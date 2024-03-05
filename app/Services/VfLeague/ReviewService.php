<?php
declare(strict_types=1);

namespace App\Services\VfLeague;

use PHPHtmlParser\Dom;

/**
 * Class ReviewService
 * @package App\Services\VfLeague
 */
class ReviewService
{
    /**
     * @var int 0
     */
    private int $atmosphereIndex = 0;

    /**
     * @var array $data
     */
    private array $data = [];

    /**
     * @var Dom $dom
     */
    private Dom $dom;

    /**
     * @var array $event
     */
    private array $event = [];

    /**
     * @var array $gameData
     */
    private array $gameData = [];

    /**
     * @var array $gameDataList
     */
    private array $gameDataList = [];

    /**
     * @var string $gameLink
     */
    private string $gameLink = '';

    /**
     * @var $tableEvent
     */
    private $tableEvent;

    /**
     * @var $tableGame
     */
    private $tableGame;

    /**
     * @var $tableScore
     */
    private $tableScore;

    /**
     * @var $tableTactic
     */
    private $tableTactic;

    private array $usedInjury = [];

    private array $usedRed = [];

    private array $usedWeather = [];

    private array $usedPenalty = [];

    private array $usedGoal = [];

    private array $weather = [
        'В очень жаркий солнечный день {visitors} зрителей пришло посмотреть матч на стадионе {stadium}.',
        'Исключительно солнечный день привлек {visitors} зрителей на стадион {stadium}.',
        'Ясный солнечный день собрал {visitors} зрителей на стадионе {stadium}.',
        '{visitors} зрителей на стадионе {stadium} загорали под ярким солнцем.',
        'Благодаря теплой и солнечной погоде {visitors} зрителей собралось на стадионе {stadium}.',
        'В жаркий солнечный день {visitors} зрителей пришло посмотреть матч на стадион {stadium}.',
        'Неплохая для футбола погода привлекла {visitors} зрителей на стадион {stadium}.',
        'Прекрасная для футбола погода на стадионе {stadium}, где собралось {visitors} зрителей.',
        'Теплая, малооблачная погода собрала {visitors} зрителей на стадионе {stadium}.',
        'Погода довольно приятная, и на стадионе {stadium} собралось {visitors} зрителей.',
        'Покрытое тучами небо заставило понервничать {visitors} зрителей, пришедших на стадион {stadium}, но дождь так и не пошел.',
        '{visitors} зрителей собралось на стадионе {stadium}, где установилась хорошая для футбола погода.',
        'В этот холодный и пасмурный день {visitors} зрителей собралось на стадионе {stadium}.',
        'Довольно пасмурная погода встретила {visitors} зрителей, пришедших сегодня на стадион {stadium}.',
        'Тучи закрыли небо над стадионом {stadium}, но {visitors} зрителей пришло посмотреть на матч.',
        '{visitors} зрителей пришло на стадион {stadium} несмотря на сильный ливень.',
        '{visitors} зрителей собралось на стадионе {stadium} под идущим весь день дождем.',
        '{visitors} зрителей собралось на стадионе {stadium}, несмотря на угрожающие тучи на горизонте.',
        '{visitors} пришедших на стадион {stadium} зрителей встретил сильный ливень.',
        '{visitors} зрителей пришло на стадион {stadium} несмотря на сильный снегопад.',
        '{visitors} зрителей собралось на стадионе {stadium} под идущим весь день снегом.',
        '{visitors} пришедших на стадион {stadium} зрителей встретил сильный снегопад.',
    ];

    private array $red = [
        '{player} заслужил неспортивным поведением красную карточку, и на {minute}-й минуте на поле стало на одного игрока меньше.',
        '{player} знал, что нарывается на неприятности, заваливая соперника руками. Несмотря на протесты, игрок на {minute}-й минуте получает красную карточку и удаляется с поля.',
        'Когда игрок {player} в очередной раз провел подкат сзади на {minute}-й минуте встречи, судья был вынужден показать ему красную карточку и отправить отдыхать.',
        'Когда на {minute}-й минуте {player} без видимых на то причин грубейшим подкатом чуть не оторвал ноги противнику прямо на глазах у бокового судьи, арбитр без малейшего колебания показал ему красную карточку.',
        'На {minute}-й минуте встречи игрок {player} намеренно ударил противника головой, и судья немедленно удалил его с поля.',
        'На {minute}-й минуте матча после очередного фола {player} получил красную карточку, и был вынужден покинуть поле.',
        'На {minute}-й минуте на поле началась небольшая драка. После консультации с боковым судьей рефери подозвал к себе зачинщика драки и показал ему красную карточку. {player} ушёл с поля.',
    ];

    private array $injury = [
        '{player} на {minute}-й минуте в результате столкновения повредил плечо и был вынужден покинуть игру.',
        '{player} на {minute}-й минуте после столкновения повредил плечо, тренер предпочел убрать игрока с поля.',
        '{player} на {minute}-й минуте после столкновения почувствовал боль в груди. С подозрением на ушиб ребра он был отправлен в больницу.',
        '{player} неудачно приземлился и повредил спину на {minute}-й минуте. Медики посоветовали ему попросить замену.',
        'На {minute}-й минуте {player} некоторое время лежал на газоне, держась за бедро, затем встал и готов был продолжить игру, но медики решили, что нужна замена.',
        'На {minute}-й минуте {player} повредил колено и смог продолжить игру.',
        'На {minute}-й минуте матча {player} из-за болевых ощущений в ноге не смог продолжить игру.',
        'На {minute}-й минуте матча {player} начал слегка прихрамывать и был заменён.',
        'На {minute}-й минуте матча {player} подвернул голеностоп и попросил замену.',
        'На {minute}-й минуте матча {player} серьезно травмировал колено и не смог продолжить игру.',
        'На {minute}-й минуте матча {player} сильно повредил ногу и покинул поле на носилках.',
        'На {minute}-й минуте матча {player} травмировал колено и не смог продолжить игру.',
    ];

    private array $penalty = [
        '{player} мог отличится на {minute}-й минуте. Судья назначил пенальти за игру рукой в штрафной площади, но вратарь выручил свою команду',
        'На {minute}-й минуте встречи {player} очень неуверенно пробил с одиннадцатиметровой отметки и не смог переиграть вратаря.',
        'На {minute}-й минуте матча {player} мог реализовать пенальти, но не попал в ворота.',
        'На {minute}-й минуте матча судья назначил пенальти, но {player} его не реализовал. {score}',
        'На {minute}-й минуте судья назначил пенальти. {player} крученым ударом в угол обманул враталя, но угодил в штангу.',
    ];

    private array $goal = [
        '{assist} блестяще продемонстрировал свои способности, на {minute}-й минуте выполнив прекрасный навес с фланга в штрафную противника. {player} выпрыгнул выше всех и головой по дуге отправил мяч в дальнюю девятку. {score}',
        '{assist} освободился от защитника за счет скоростного рывка, сделал пас партнеру, и {player} на {minute}-й минуте забил гол. {score}',
        '{assist} подтвердил репутацию искателя нестандартных путей к воротам соперника, когда на {minute}-й минуте неожиданно отдал ловкий короткий пас, а {player} завершил атаку точным ударом. {score}',
        '{player} беспощадно налетел на соперника, отобрал у него мяч, работая корпусом, протащил его в штрафную соперника и забил гол на {minute}-й минуте. {score}',
        '{player} воспользовался ошибкой соперника в центре обороны и забил гол на {minute}-й минуте. {score}',
        '{player} воспользовался ошибкой соперника в центре обороны, вызванной несогласованными действиями вратаря и защитника, и забил гол на {minute}-й минуте. {score}',
        '{player} забил гол на {minute}-й минуте встречи, получив мяч с фланга. {score}',
        '{player} забил гол на {minute}-й минуте матча после контратаки по флангу. {score}',
        '{player} изменил счет в матче на {minute}-й минуте, нанеся потрясающий удар с дальней дистанции. Точно в угол! Вратарю соперника ничего больше не осталось, как доставать мяч из сетки ворот. {score}',
        '{player} на {minute}-й минуте матча прошел через центральную зону защиты соперника и пробил в дальний от вратаря угол. {score}',
        '{player} отличился в результате атаки по флангу на {minute}-й минуте матча. {score}',
        '{player} отличился на {minute}-й минуте. Гол был забит с пенальти, назначенного за игру рукой в штрафной площади. {score}',
        '{player} продемонстрировал свою невероятную способность создавать моменты буквально на пустом месте. На {minute}-й минуте матча он нанес удар пяткой, стоя спиной к воротам. Вратарь оказался не готов к такому повороту. {score}',
        '{player} совершил впечатляющий по скорости рывок, оторвался от замешкавшегося защитника и пробил точно в створ ворот на {minute}-й минуте встречи. {score}',
        '{player}, на {minute}-й минуте пройдя по флангу, воспользовался ошибкой обороны и пробил точно в угол. {score}',
        'Атака по флангу на {minute}-й минуте встречи закончилась голом - {player} точно пробил с острого угла. {score}',
        'Благодаря ошибке в центре обороны на {minute}-й минуте {player} забил гол. {score}',
        'Благодаря своему преимуществу в опыте {player} воспользовался минутным замешательством защитников противника, отобрал мяч и элегантно забил гол на {minute}-й минуте встречи. {score}',
        'Быстрый {assist} убежал от защитников на {minute}-й минуте и выдал великолепный пас на ход партнеру по команде. {player} легко переиграл вратаря. {score}',
        'В результате быстрой атаки по флангу на {minute}-й минуте {player} вышел один на один с вратарем и не упустил свой шанс. {score}',
        'В результате восхитительной комбинации по центру на {minute}-й минуте матча {player} остался один перед воротами и легко переиграл вратаря. {score}',
        'Волна восхищения пронеслась по трибунам, когда {player} обыграл всю защиту противника и забил на {minute}-й минуте матча. {score}',
        'Вратарь не смог ничего сделать, когда {player} на {minute}-й минуте, легко обыграв соперника, забил красивый гол. {score}',
        'Всем показалось, что {player} словно завис в воздухе, когда элегантным ударом головой он отправил мяч в сетку ворот. Это произошло после углового, который исполнил {assist} на {minute}-й минуте встречи. {score}',
        'Защитники были обмануты действиями соперника на {minute}-й минуте. В результате хорошо отрепетированного розыгрыша мяч сначала полетел на дальнюю штангу, откуда его вернули на противоположный край штрафной площади. {player} оставалось лишь не попасть во вратаря. {score}',
        'Казалось, эпизод на {minute}-й минуте матча, завершился ничем - мяч летел вдоль ворот. Однако удар оказался замечательным пасом и {player} на него откликнулся. {score}',
        'Мгновенно произошло переключение из защиты в атаку, когда во время очередной контратаки на {minute}-й минуте матча {player} прошел по центру поля и забил гол. {score}',
        'Мяч почти ушел за линию ворот, но {assist} в последний момент смог отдать пас под очень острым углом, и {player} нв {minute}-й минуте замкнул передачу на ближней штанге. {score}',
        'На {minute}-й минуте в результате атаки по флангу {player} забил гол, воспользовавшись грубой ошибкой защиты. {score}',
        'На {minute}-й минуте {player} воспользовался ошибкой защитников на фланге и метко пробил по воротам. {score}',
        'На {minute}-й минуте {player} забил гол с невероятной дистанции. {score}',
        'На {minute}-й минуте {player} завершил атаку по флангу великолепным ударом через себя. {score}',
        'На {minute}-й минуте {player} легко завершил контратаку своей команды по флангу. {score}',
        'На {minute}-й минуте {player} нанес сильный удар по воротам, выйдя по центру один на один с вратарем. {score}',
        'На {minute}-й минуте {player} перебросил мяч через вратаря в результате атаки по флангу. {score}',
        'На {minute}-й минуте {player} получил пас по центру, прорвался сквозь оборону соперника, вышел один на один и мастерски перекинул мяч через вратаря. {score}',
        'На {minute}-й минуте {player} получил точную передачу на линии штрафной площади, развернулся лицом к воротам и нанес блестящий удар в нижний угол - голкипер бессилен. {score}',
        'На {minute}-й минуте атаку по центру успешно завершил {player}. {score}',
        'На {minute}-й минуте в результате комбинации по центру {player} получил пас вразрез, убежал от защитника и забил гол. {score}',
        'На {minute}-й минуте вместо навеса в центр штрафной площади последовал короткий пас назад прямо на ногу игрока {player}. Сильный удар издали достиг цели, несмотря на то, что вратарь соперников дотянулся кончиками пальцев до мяча. {score}',
        'На {minute}-й минуте встречи {assist} мастерски выполнил навес от углового флажка и {player} не упустил свой шанс. {score}',
        'На {minute}-й минуте встречи {player} забил после элегантной атаки на фланге. {score}',
        'На {minute}-й минуте встречи {player} прорвался сквозь центр защиты соперника и катнул мяч под опорную ногу вратаря. {score}',
        'На {minute}-й минуте встречи {player} проскочил через центр обороны противника и забил гол. {score}',
        'На {minute}-й минуте встречи {player} прошел по флангу и забил красивый гол, элегантно перекинув мяч через вратаря гостей. {score}',
        'На {minute}-й минуте встречи {player} прошёл по центру, обыграл защитников и забил гол в ворота соперника. {score}',
        'На {minute}-й минуте встречи {player} уверенно забил с одиннадцатиметровой отметки. {score}',
        'На {minute}-й минуте встречи {player}, получив пас, прорвался в штрафную площадку через центр обороны соперника и вколотил мяч точно под перекладину. {score}',
        'На {minute}-й минуте защитники неудачно выстроили стенку при пробивании штрафного удара, и {player} спокойно их прошил. {score}',
        'На {minute}-й минуте игры {assist} сделал неожиданный рывок, убежал с мячом далеко вперед и сделал прекрасную передачу набегавшему партнёру, и {player} не упустил своего шанса. {score}',
        'На {minute}-й минуте игры {player} отличился после подачи с фланга. {score}',
        'На {minute}-й минуте игры {player}, будучи игроком атлетичным, здорово воспользовался своими данными и вынудил ошибиться защитников. {score}',
        'На {minute}-й минуте матча {assist} сделал отличный навес с фланга и {player}, высоко выпрыгнув, достал верховой мяч и головой подрезал его в дальний от вратаря угол. {score}',
        'На {minute}-й минуте матча {player} без труда реализовал пенальти. {score}',
        'На {minute}-й минуте матча {player} забил гол после контратаки по центру. {score}',
        'На {minute}-й минуте матча {player} не стал ввязываться в верховую дуэль, а технично подтолкнув зависшего в воздухе соперника, овладел мячом, вышел один на один и пушечным ударом пробил во вратаря! К счастью, обошлось без травм - вратарь успел увернуться. Защитник, проигравший воздушную дуэль, все еще оставался на поле и пытался апеллировать к арбитру, однако судья не изменил своего решения. {score}',
        'На {minute}-й минуте матча {player} неожиданно ускорился, перехватил пас защитника соперника и издевательски легко обыграл вратаря. {score}',
        'На {minute}-й минуте матча {player} принёс гол в копилку своей команды благодаря прекрасной атаке по флангу. {score}',
        'На {minute}-й минуте матча {player} прошёл защиту соперника по центру и пробил точно в сетку. {score}',
        'На {minute}-й минуте матча был забит гол. После атаки по флангу комбинацию завершил {player}. {score}',
        'На {minute}-й минуте матча защитник зачем-то навесил мяч в свою штрафную площадку. Ошибкой воспользовался {player}. {score}',
        'На {minute}-й минуте матча защитник упустил своего визави, {player} сделал резкий рывок к штрафной площадке и хлестким ударом забил гол. {score}',
        'На {minute}-й минуте матча находившийся на фланге атаки {player} воспользовался образовавшейся брешью в обороне соперника и точно пробил под перекладину. {score}',
        'На {minute}-й минуте матча одной из прекрасных подач с фланга воспользовался {player} и забил гол. {score}',
        'На {minute}-й минуте матча после ошибки защиты мяч попал к сопернику, {player} прошёл по флангу и метко пробил. {score}',
        'На {minute}-й минуте матча после подачи с фланга {assist} великолепно скинул мяч и {player} пробил, не оставив никаких шансов вратарю. {score}',
        'На {minute}-й минуте матча судья назначил пенальти, который с легкостью реализовал {player}. {score}',
        'На {minute}-й минуте прекрасний навес с фланга завершил {player}, забив гол. {score}',
        'На {minute}-й минуте прошла отличная комбинация на фланге, которую завершил {player}, невероятно точным ударом перебросив мяч через вратаря. {score}',
        'На {minute}-й минуте со свободного удара пошла высокая подача в район одиннадцатиметровой отметки. После выверенной скидки назад {player} без труда забил гол. {score}',
        'На {minute}-й минуте судья назналич свободный из не самой выгодной позиции. Вместо навеса последовал пас во вратарскую площадку, слаженные действия атакующих игроков дезориентировали защиту соперника. Мяч заметался в штрафной площадке, и {player} смог протолкнуть его мимо вратаря в сетку. {score}',
        'На {minute}-й минуте судья назначил пенальти. {player} крученым ударом в угол переиграл враталя. {score}',
        'Откровением для болельщиков стал гол, забитый на {minute}-й минуте матча, когда {player} прорвался по флангу сквозь защиту соперника и пробил точно в створ ворот. {score}',
        'Отличная комбинация на фланге завершилась голом на {minute}-й минуте, который провел {player}. {score}',
        'Ошибка в центре обороны на {minute}-й минуте привела к пропущенному голу, который забил {player}. {score}',
        'После опасной контратаки на {minute}-й минуте матча {player}, получив длинный пас, прошел по флангу и забил гол. {score}',
        'После отличной комбинации на фланге игрок {player} смог забить на {minute}-й минуте игры. {score}',
        'После отличной комбинации по центру {player} на {minute}-й минуте забил важный в ворота соперника. {score}',
        'Потрясающая контратака по флангу прошла на {minute}-й минуте и {player} пробил точно в угол. {score}',
        'Потрясающей точности навес выполнил {assist} с фланга и нашёл в штрафной площадке партнера. Благодаря этому {player} на {minute}-й минуте неотразимым ударом головой забил прекрасный гол. {score}',
        'Прекрасная комбинация на фланге закончилась взятием ворот на {minute}-й минуте матча. Гол забил {player}. {score}',
        'Прекрасная комбинация, которую игроки разучивали на тренировке. Закрученный мяч дезориентировал защитников, и они упустили свободного игрока. {player} забил гол на {minute}-й минуте игры. {score}',
        'Прорыв игрока {player} по флангу и последовавший точный удар с острого угла на {minute}-й минуте встречи застал соперников врасплох. {score}',
        'Стадион взорвался аплодисментами, когда на {minute}-й минуте {player} переиграл по центру защиту гостей и элегантно перебросил мяч через вратаря. {score}',
        'Счёт в мачте изменился, после того как на {minute}-й минуте встречи оставшийся наедине с вратарем противника {player} получил пас с фланга и не упустил свой шанс. {score}',
        'Трибуны притихли, после того как на {minute}-й минуте {player} удачно пробил после атаки по флангу. {score}',
        'Усилия игроков на {minute}-й минуте встречи завершились успехом и после превосходной комбинации на фланге {player} забивил гол. {score}',
        'Фланги в этом матче были особенно опасены. На {minute}-й минуте, после передачи с фланга, {player} оставил голкипера не у дел, легко забив гол. {score}',
    ];

    private array $goalTypes = [
        '(головой), с углового' => [
            23,
            40,
            51,
            81,
        ],
        '(головой), со штрафного' => [
            51,
            52,
            69,
            81,
        ],
        '(головой), удар с близкого расстояния' => [
            15,
            16,
            18,
            20,
            24,
            25,
            27,
            28,
            29,
            32,
            34,
            37,
            41,
            51,
            52,
            54,
            57,
            59,
            65,
            68,
            69,
            74,
            76,
            77,
            78,
            79,
            80,
            81,
            84,
            85,
            86,
            87,
        ],
        '(головой), замкнул прострел с фланга' => [
            0,
            6,
            7,
            10,
            15,
            16,
            18,
            27,
            28,
            29,
            32,
            34,
            41,
            50,
            51,
            52,
            57,
            59,
            63,
            67,
            68,
            73,
            76,
            78,
            79,
            80,
            81,
            84,
            85,
            86,
            87,
        ],
        'с пенальти' => [
            11,
            46,
            53,
            66,
            71,
        ],
        'с углового' => [
            40,
            81,
        ],
        'со штрафного' => [
            30,
            48,
            69,
            70,
            81,
        ],
        'выход один на один' => [
            1,
            2,
            3,
            16,
            17,
            19,
            20,
            26,
            33,
            35,
            37,
            38,
            42,
            43,
            47,
            49,
            54,
            56,
            58,
            61,
            68,
            74,
            83,
        ],
        'замкнул прострел с фланга' => [
            1,
            2,
            4,
            5,
            6,
            7,
            10,
            12,
            15,
            16,
            18,
            27,
            28,
            29,
            31,
            32,
            34,
            41,
            49,
            50,
            51,
            55,
            57,
            59,
            63,
            67,
            68,
            73,
            74,
            76,
            78,
            80,
            81,
            84,
            85,
            86,
            87,
        ],
        'удар с близкого расстояния' => [
            1,
            2,
            3,
            4,
            5,
            9,
            12,
            13,
            14,
            15,
            16,
            17,
            18,
            20,
            21,
            22,
            24,
            25,
            26,
            27,
            28,
            29,
            31,
            32,
            34,
            37,
            38,
            41,
            42,
            43,
            44,
            45,
            47,
            49,
            50,
            54,
            55,
            56,
            57,
            58,
            59,
            60,
            61,
            62,
            64,
            65,
            68,
            69,
            72,
            73,
            74,
            75,
            76,
            77,
            78,
            80,
            81,
            82,
            83,
            84,
            85,
            86,
            87,
        ],
        'удар со средней дистанции' => [
            1,
            2,
            3,
            4,
            5,
            9,
            13,
            14,
            16,
            17,
            18,
            21,
            22,
            26,
            29,
            36,
            37,
            38,
            43,
            44,
            45,
            47,
            49,
            54,
            55,
            57,
            58,
            59,
            60,
            61,
            62,
            64,
            65,
            68,
            69,
            72,
            75,
            76,
            77,
            78,
            80,
            81,
            82,
            83,
            85,
            86,
        ],
        'из-за пределов штрафной' => [
            8,
            22,
            30,
            39,
        ],
        'удар издали' => [
            8,
            30,
            39,
        ],
    ];

    private array $weatherTypes = [
        'очень жарко' => [
            0,
            1,
            2,
            3,
        ],
        'жарко' => [
            1,
            2,
            3,
            5,
        ],
        'солнечно' => [
            1,
            2,
            3,
            4,
            6,
            8,
            9,
            11,
        ],
        'облачно' => [
            6,
            7,
            8,
            9,
            10,
            11,
        ],
        'пасмурно' => [
            6,
            7,
            9,
            10,
            11,
            12,
            13,
            14,
            17,
        ],
        'дождь' => [
            15,
            16,
            18,
        ],
        'снег' => [
            19,
            20,
            21,
        ],
    ];

    private int $champId;

    private int $tourId;

    public function __construct(int $champId, int $tourId)
    {
        $this->champId = $champId;
        $this->tourId = $tourId;

        $this->dom = new Dom();

        $this->prepareData();

        return $this->data;
    }

    /**
     * @return void
     */
    private function prepareData(): void
    {
        $this->parseChampionshipPage();
        $this->parseGameList();
        $this->generateData();
    }

    private function generateData()
    {
        foreach ($this->gameDataList as $gameData) {
            $this->gameData = $gameData;
            $this->data[] = $this->generateGameText();
        }
    }

    private function generateGameText()
    {
        return $this->generateWeatherText()
            . PHP_EOL
            . $this->generateCoachText()
            . PHP_EOL
            . $this->generateEventsText()
            . PHP_EOL
            . $this->generateNoGoalText();
    }

    private function generateWeatherText()
    {
        foreach ($this->weatherTypes as $key => $value) {
            if (str_contains($this->gameData['weather'], $key)) {
                $tryValue = array_diff($value, array_intersect($value, $this->usedWeather));
                if ($tryValue) {
                    $value = $tryValue;
                }
                $weatherTextIndex = array_rand(array_flip($value));
                $this->usedWeather[] = $weatherTextIndex;

                return str_replace(
                    ['{visitors}', '{stadium}'],
                    [$this->gameData['visitor'], $this->gameData['stadium']],
                    $this->weather[$weatherTextIndex]
                );
            }
        }
        return '';
    }

    private function generateNoGoalText()
    {
        if ('0:0' != $this->gameData['score']) {
            return '';
        }

        $text = [
            'Хотя оба соперника имели шансы для взятия ворот, но матч закончился сухой ничьей.',
            'Никто не допустил ошибок, потому и голов в матче зрители не увидели.',
            'Не скажешь, что матч был скучным, но до голов дело так и не дошло.',
        ];

        return array_rand(array_flip($text));
    }

    private function generateCoachText()
    {
        $result = [];
        if ($this->gameData['home_style'] > $this->gameData['guest_style']) {
            $result[] = 'Тренер хозяев смог угадать с коллизией в этом матче.';
        } elseif ($this->gameData['guest_style'] > $this->gameData['home_style']) {
            $result[] = 'Гости смогли подловить соперника на коллизии.';
        }

        if ('супер' == $this->gameData['home_mood'] && 'супер' == $this->gameData['guest_mood']) {
            $result[] = 'Оба тренера крайне серьезно подошли к игре и выставили обоюдный супер.';
        } elseif ('отдых' == $this->gameData['home_mood'] && 'отдых' == $this->gameData['guest_mood']) {
            $result[] = 'Оба тренера крайне расслаблено подошли к игре и выставили обоюдный отдых.';
        } elseif ('супер' == $this->gameData['home_mood'] && 'отдых' == $this->gameData['guest_mood']) {
            $result[] = 'Хозяева и гости по разному оценили важность матче - первые сыграли супером, а вторые взяли отдых.';
        } elseif ('отдых' == $this->gameData['home_mood'] && 'супер' == $this->gameData['guest_mood']) {
            $result[] = 'Хозяева и гости по разному оценили важность матче - первые взяли отдых, а вторые сыграли супером.';
        } elseif ('супер' == $this->gameData['home_mood']) {
            $result[] = 'Наставник домашней команды счёл этот матч очень важным и использовал супер.';
        } elseif ('отдых' == $this->gameData['home_mood']) {
            $result[] = 'Тренер хозяев решил, что матч не имеет большей ценности и сыграл отдыхом.';
        } elseif ('супер' == $this->gameData['guest_mood']) {
            $result[] = 'Наставник гостевой команды счёл этот матч очень важным и использовал супер.';
        } elseif ('отдых' == $this->gameData['guest_mood']) {
            $result[] = 'Тренер гостей решил, что матч не имеет большей ценности и сыграл отдыхом.';
        }

        return implode(PHP_EOL, $result);
    }

    private function generateEventsText()
    {
        $result = [];
        foreach ($this->gameData['events'] as $event) {
            $this->event = $event;
            if ('Гол' == $event['type']) {
                $result[] = $this->generateGoalText();
            }
            if ('Незабитый пенальти' == $event['type']) {
                $result[] = $this->generatePenaltyText();
            }
            if ('Красная карточка' == $event['type']) {
                $result[] = $this->generateRedText();
            }
            if ('Травма' == $event['type']) {
                $result[] = $this->generateInjuryText();
            }
        }
        return implode(PHP_EOL, $result);
    }

    private function generateGoalText()
    {
        foreach ($this->goalTypes as $key => $value) {
            if (str_contains($this->event['text'], $key)) {
                $tryValue = array_diff($value, array_intersect($value, $this->usedGoal));
                if ($tryValue) {
                    $value = $tryValue;
                }
                $goalTextIndex = array_rand(array_flip($value));
                $text = $this->goal[$goalTextIndex];
                if (str_contains($text, '{assist}') && !array_key_exists('assist', $this->event)) {
                    return $this->generateGoalText();
                }

                $this->usedGoal[] = $goalTextIndex;

                return str_replace(
                    ['{player}', '{minute}', '{assist}', '{score}'],
                    [
                        $this->event['player'],
                        $this->event['minute'],
                        $this->event['assist'] ?? '',
                        $this->event['score']
                    ],
                    $this->goal[$goalTextIndex]
                );
            }
        }
        return '';
    }

    private function generatePenaltyText()
    {
        $penalty = $this->penalty;
        $tryPenalty = array_diff($penalty, array_intersect($penalty, $this->usedPenalty));
        if ($tryPenalty) {
            $penalty = $tryPenalty;
        }
        $penaltyTextIndex = array_rand($penalty);
        $this->usedPenalty[] = $this->penalty[$penaltyTextIndex];

        return str_replace(
            ['{player}', '{minute}'],
            [$this->event['player'], $this->event['minute']],
            $this->penalty[$penaltyTextIndex]
        );
    }

    private function generateRedText()
    {
        $red = $this->red;
        $tryRed = array_diff($red, array_intersect($red, $this->usedRed));
        if ($tryRed) {
            $red = $tryRed;
        }
        $redTextIndex = array_rand($red);
        $this->usedRed[] = $this->red[$redTextIndex];

        return str_replace(
            ['{player}', '{minute}'],
            [$this->event['player'], $this->event['minute']],
            $this->red[$redTextIndex]
        );
    }

    private function generateInjuryText()
    {
        $injury = $this->injury;
        $tryInjury = array_diff($injury, array_intersect($injury, $this->usedInjury));
        if ($tryInjury) {
            $injury = $tryInjury;
        }
        $injuryTextIndex = array_rand($injury);
        $this->usedInjury[] = $this->injury[$injuryTextIndex];

        return str_replace(
            ['{player}', '{minute}'],
            [$this->event['player'], $this->event['minute']],
            $this->injury[$injuryTextIndex]
        );
    }

    private function parseChampionshipPage()
    {
        $this->dom->loadFromUrl('https://vfliga.com/v2champ.php?num=' . $this->champId . '&tblshow=1&tour=' . $this->tourId);
    }

    private function parseGameList()
    {
        $gameListTable = $this->dom->find('table')[0]->find('table')[3];
        $trList = $gameListTable->find('tr');
        foreach ($trList as $i => $trItem) {
            $this->gameLink = $trItem->find('a')[2]->href;
            $this->parseGameItem();
        }
    }

    private function parseGameItem()
    {
        $this->loadGame();
        $this->loadBaseGameTables();
        $this->generateGameData();
    }

    private function loadGame()
    {
        $url = 'https://vfliga.com/' . htmlspecialchars_decode($this->gameLink);
        $this->dom->loadFromUrl($url);
    }

    private function loadBaseGameTables()
    {
        $this->tableGame = $this->dom->find('table')[0];
        $this->tableScore = $this->tableGame->find('table')[2];
        $this->tableTactic = $this->tableGame->find('table')[3];
        $this->tableEvent = $this->tableGame->find('table')[5];
    }

    private function generateGameData()
    {
        $this->gameDataList[] = [
            'score' => $this->getScore(),
            'weather' => $this->getWeather(),
            'stadium' => $this->getStadium(),
            'visitor' => $this->getVisitor(),
            'home_team' => $this->getHomeTeamName(),
            'home_style' => $this->getHomeCollision(),
            'home_defence_loose' => $this->getHomeDefenceLoose(),
            'home_rudeness' => $this->getHomeRudeness(),
            'home_atmosphere' => (int)$this->getHomeAtmosphere(),
            'home_optimality_1' => $this->getHomeOptimality1(),
            'home_optimality_2' => $this->getHomeOptimality2(),
            'home_mood' => $this->getHomeMood(),
            'home_teamwork' => $this->getHomeTeamwork(),
            'guest_team' => $this->getGuestTeamName(),
            'guest_style' => $this->getGuestCollision(),
            'guest_defence_loose' => $this->getGuestDefenceLoose(),
            'guest_rudeness' => $this->getGuestRudeness(),
            'guest_atmosphere' => (int)$this->getGuestAtmosphere(),
            'guest_optimality_1' => $this->getGuestOptimality1(),
            'guest_optimality_2' => $this->getGuestOptimality2(),
            'guest_mood' => $this->getGuestMood(),
            'guest_teamwork' => $this->getGuestTeamwork(),
            'events' => $this->getEvents(),
        ];
    }

    private function getScore()
    {
        $tableTeam = $this->tableScore->find('table')[0];
        $score = $tableTeam->find('b')[1];
        return $score->innerHtml;
    }

    private function getWeather()
    {
        $data = $this->tableScore->find('div')[0]->innerHtml;
        $data = explode('Погода:', $data)[1];
        $data = explode('. Стадион', $data)[0];
        return trim(strip_tags($data));
    }

    private function getStadium()
    {
        $data = $this->tableScore->find('div')[0];
        $data = $data->find('a')[1];
        return $data->innerHtml;
    }

    private function getVisitor()
    {
        $data = $this->tableScore->find('div')[0]->innerHtml;
        $data = explode('Зрителей:', $data)[1];
        $data = explode('. Билет:', $data)[0];
        $data = str_replace(' ', '', $data);
        return trim($data);
    }


    private function getHomeTeamName()
    {
        $tableTeam = $this->tableScore->find('table')[0];
        $homeTeam = $tableTeam->find('a')[0];
        $homeTeamName = $homeTeam->find('b')[0];
        return $homeTeamName->innerHtml;
    }

    private function getHomeCollision()
    {
        $styleTr = $this->tableTactic->find('tr')[2];
        $homeStyle = $styleTr->find('td')[0];
        $style = $homeStyle->style;
        if ('color:#00FF00' == $style) {
            return 1;
        }
        if ('color:#FF0000' == $style) {
            return -1;
        }
        return 0;
    }

    private function getHomeDefenceLoose()
    {
        $defenceTr = $this->tableTactic->find('tr')[3];
        $homeDefence = $defenceTr->find('td')[0];
        return $homeDefence->style ? 1 : 0;
    }

    private function getHomeRudeness()
    {
        $rudenessTr = $this->tableTactic->find('tr')[5];
        $homeRudeness = $rudenessTr->find('i')[0];
        return $homeRudeness->innerHtml;
    }

    private function getHomeAtmosphere()
    {
        $atmosphereTr = $this->tableTactic->find('tr')[6];
        $atmosphereTd = $atmosphereTr->find('td')[1];
        if ('Атмосфера' != $atmosphereTd->innerHtml) {
            $this->atmosphereIndex = 0;
            return '';
        }
        $this->atmosphereIndex = 1;
        $homeAtmosphere = $atmosphereTr->find('i')[0];
        return (int)str_replace(['%', '+'], '', $homeAtmosphere->innerHtml);
    }

    private function getHomeOptimality1()
    {
        $optimalityTr = $this->tableTactic->find('tr')[7 + $this->atmosphereIndex];
        $homeOptimality1 = $optimalityTr->find('i')[0];
        return str_replace('%', '', $homeOptimality1->innerHtml);
    }

    private function getHomeOptimality2()
    {
        $optimalityTr = $this->tableTactic->find('tr')[7 + $this->atmosphereIndex];
        $homeOptimality2 = $optimalityTr->find('i')[1];
        return str_replace('%', '', $homeOptimality2->innerHtml);
    }

    private function getHomeMood()
    {
        $moodTr = $this->tableTactic->find('tr')[6 + $this->atmosphereIndex];
        $homeMood = $moodTr->find('i')[0];
        if ($homeMood->find('span')[0]) {
            $homeMood = $homeMood->find('span')[0];
        }
        return $homeMood->innerHtml;
    }

    private function getHomeTeamwork()
    {
        $teamworkTr = $this->tableTactic->find('tr')[9 + $this->atmosphereIndex];
        $homeTeamwork = $teamworkTr->find('i')[0];
        return str_replace(['%', '+'], '', $homeTeamwork->innerHtml);
    }

    private function getGuestTeamName()
    {
        $tableTeam = $this->tableScore->find('table')[0];
        $guestTeam = $tableTeam->find('a')[1];
        $guestTeamName = $guestTeam->find('b')[0];
        return $guestTeamName->innerHtml;
    }

    private function getGuestCollision()
    {
        $styleTr = $this->tableTactic->find('tr')[2];
        $guestStyle = $styleTr->find('td')[2];
        $style = $guestStyle->style;
        if ('color:#00FF00' == $style) {
            return 1;
        }
        if ('color:#FF0000' == $style) {
            return -1;
        }
        return 0;
    }

    private function getGuestDefenceLoose()
    {
        $defenceTr = $this->tableTactic->find('tr')[3];
        $guestDefence = $defenceTr->find('td')[2];
        return $guestDefence->style ? 1 : 0;
    }

    private function getGuestRudeness()
    {
        $rudenessTr = $this->tableTactic->find('tr')[5];
        $guestRudeness = $rudenessTr->find('i')[1];
        return $guestRudeness->innerHtml;
    }

    private function getGuestAtmosphere()
    {
        $atmosphereTr = $this->tableTactic->find('tr')[6];
        $atmosphereTd = $atmosphereTr->find('td')[1];
        if ('Атмосфера' != $atmosphereTd->innerHtml) {
            return '';
        }
        $guestAtmosphere = $atmosphereTr->find('i')[1];
        return (int)str_replace(['%', '+'], '', $guestAtmosphere->innerHtml);
    }

    private function getGuestOptimality1()
    {
        $optimalityTr = $this->tableTactic->find('tr')[7 + $this->atmosphereIndex];
        $guestOptimality1 = $optimalityTr->find('i')[2];
        return str_replace('%', '', $guestOptimality1->innerHtml);
    }

    private function getGuestOptimality2()
    {
        $optimalityTr = $this->tableTactic->find('tr')[7 + $this->atmosphereIndex];
        $guestOptimality2 = $optimalityTr->find('i')[3];
        return str_replace('%', '', $guestOptimality2->innerHtml);
    }

    private function getGuestMood()
    {
        $moodTr = $this->tableTactic->find('tr')[6 + $this->atmosphereIndex];
        $guestMood = $moodTr->find('i')[1];
        if ($guestMood->find('span')[0]) {
            $guestMood = $guestMood->find('span')[0];
        }
        return $guestMood->innerHtml;
    }

    private function getGuestTeamwork()
    {
        $teamworkTr = $this->tableTactic->find('tr')[9 + $this->atmosphereIndex];
        $guestTeamwork = $teamworkTr->find('i')[1];
        return str_replace(['%', '+'], '', $guestTeamwork->innerHtml);
    }

    private function getEvents()
    {
        $trEventList = $this->tableEvent->find('tr');

        $result = [];
        foreach ($trEventList as $key => $trEvent) {
            if ($key < 3) {
                continue;
            }

            $eventTd = $trEvent->find('td');

            if ($eventTd[0]->innerHtml) {
                $minute = $eventTd[0]->innerHtml;
            }

            $type = $eventTd[1] ? $eventTd[1]->title : '';

            if (!in_array($type, ['Гол', 'Незабитый пенальти', 'Красная карточка', 'Травма'])) {
                continue;
            }

            $event = [
                'type' => $type,
                'minute' => $minute,
                'player' => $eventTd[3]->find('a')[0]->innerHtml,
            ];

            if (in_array($type, ['Гол', 'Травма'])) {
                $event['text'] = $eventTd[3]->innerHtml;
            }

            if ('Гол' == $type) {
                $event['score'] = $eventTd[4]->innerHtml;
                if ($eventTd[3]->find('a')[1]) {
                    $event['assist'] = $eventTd[3]->find('a')[1]->innerHtml;
                }
            }

            $result[] = $event;
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
