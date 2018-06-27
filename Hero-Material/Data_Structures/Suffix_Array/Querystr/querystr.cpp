#include <cstdio>
#include <cstdlib>
#include <cmath>
#include <cstring>
#include <string>
#include <vector>
#include <deque>
#include <list>
#include <set>
#include <map>
#include <stack>
#include <queue>
#include <utility>
#include <algorithm>

#define MAXN 1000005
#define MAXQ 100005
#define INF 0x3f3f3f3f
#define X first
#define Y second
#define mp make_pair

using namespace std;

typedef long long llint;
typedef pair<int,int> pii;

char s[MAXN];
string str;
int P[30][MAXN], q[MAXQ], Q, step;
pair< int, pii > temp[MAXN];

void Read() {
    int i, len;

    scanf ("%s %d", s, &Q);
    len = strlen ( s );
    for ( i=0; i<len; ++i ) {
        str.push_back( s[len-i-1] );
    }

    for ( i=1; i<=Q; ++i ) {
        scanf ("%d", &q[i]);
    }

}

int LCP ( int a, int b ) {
    int i, ans=0;

    if ( a==b ) return str.size() - a;
    for ( i=step; i>=0 && a<str.size() && b<str.size(); --i ) {
        if ( P[i][a] == P[i][b] ) {
            ans += (1<<i);
            a += (1<<i);
            b += (1<<i);
        }
    }

    return ans;
}

void Make_Tree() {
    int i, j, count;

    for ( i=0; i<str.size(); ++i ) {
        P[0][i] = str[i];
    }

    for ( step=1, j=1; j<str.size(); j*=2, ++step ) {
        for ( i=0; i<str.size(); ++i ) {
            temp[i] = mp ( P[step-1][i], mp ( i+j < str.size() ? P[step-1][i+j] : 0, i ) );
        }
        sort (temp, temp+str.size());
        
        count = 0;
        P[step][ temp[0].Y.Y ] = 0;
        for ( i=1; i<str.size(); ++i ) {
            if ( temp[i].X != temp[i-1].X || temp[i].Y.X != temp[i-1].Y.X ) {
                ++count;
            }
            P[step][ temp[i].Y.Y ] = count;
        }
    }

    --step;
}

void Answer () {
    int i;

    for ( i=1; i<=Q; ++i ) {
        printf ("%d\n", LCP(0,str.size()-q[i]));
    }
}

int main ( void ) {
#ifdef DEBUG
    freopen ("input","r",stdin);
#endif

    int i, T;

    for ( i=1, scanf("%d", &T); i<=T; ++i ) {
        Read();
        Make_Tree();
        Answer();
    }

    return 0;
}
