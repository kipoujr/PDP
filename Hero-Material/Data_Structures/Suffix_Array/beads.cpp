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

#define MAXN 200005
#define INF 0x3f3f3f3f
#define X first
#define Y second
#define mp make_pair

using namespace std;

typedef long long llint;
typedef pair<int,int> pii;

int N, P[30][MAXN], step;
char s[MAXN];
pair< int, pii > temp[MAXN];

int LCP ( int a, int b ) {
    int i, sol=0;

    for ( i=step; i>=0 && a<N && b<N; --i ) {
        if ( P[i][a] == P[i][b] ) {
            sol += (1<<i);
            a += (1<<i);
            b += (1<<i);
        }
    }

    return sol;
}

void Make_Tree() {
    int i, j, count;

    scanf ("%s", s);
    N = strlen(s);
    for ( i=0; i<N; ++i ) {
        s[i+N] = s[i];
    }
    N *= 2;

    for ( i=0; i<N; ++i ) {
        P[0][i] = s[i];
    }

    for ( step=1, j=1; j<N; j<<=1, ++step ) {
        for ( i=0; i<N; ++i ) {
            temp[i] = mp ( P[step-1][i], mp( i+j<N ? P[step-1][i+j] : -1, i ) );
        }
        sort ( temp, temp+N );

        P[step][ temp[0].Y.Y ] = 0;
        count = 0;
        for ( i=1; i<N; ++i ) {
            if ( temp[i].X != temp[i-1].X || temp[i].Y.X != temp[i-1].Y.X ) {
                ++count;
            }
            P[step][ temp[i].Y.Y ] = count;
        }
    }

    --step;
#ifdef NO
    for ( i=0; i<N; ++i ) {
        printf ("%d %d\n", temp[i].Y.Y, N);
    }
    printf ("\n");
#endif
}

void Compute() {
    int i, first, ans;

    for ( i=0; i<N; ++i ) {
        if ( temp[i].Y.Y <= N/2 ) {
            break;
        }
    }
    first = ans = temp[i].Y.Y;

    for ( ++i; i<N; ++i ) {
        if ( temp[i].Y.Y >= N/2 ) {
            continue;
        }

        if ( LCP ( temp[i].Y.Y, first ) >= N/2 ) {
            ans = min ( first, temp[i].Y.Y );
        }
        else {
            break;
        }
    }

    printf ("%d\n", ans+1);
}

int main ( void ) {
#ifdef D
    freopen ("input","r",stdin);
#endif
    int i, T;

    for ( i=1, scanf ("%d", &T); i<=T; ++i ) {
        Make_Tree();
        Compute();
    }

    return 0;
}
