var PathSection = React.createClass({
    getInitialState: function() {
        return {
            paths: []
        }
    },

    componentDidMount: function() {
        this.loadPathsFromServer();
        setInterval(this.loadPathsFromServer, 1000);
    },

    loadPathsFromServer: function() {
        $.ajax({
            url: this.props.url,
            success: function (data) {
                this.setState({ paths: data.paths });
            }.bind(this)
        });
    },

    render: function() {
        return (
            <PathsList paths={this.state.paths} />
        );
    }
});

var PathsList = React.createClass({
    render: function() {
        var pathNodes = this.props.paths.map(function(path) {
            return (
                <PathBox libelle={path.libelle} diplome={path.diplome} abonnement={path.abonnement} id={path.id}>{path.libelle}</>
            );
        });

        return (
                {pathNodes}
        );
    }
});

var PathBox = React.createClass({
    render: function() {
        return (
            <tr>
                <td>
                    {this.props.libelle}
                </td>
                <td>
                    {this.props.diplome}
                </td>
                <td>
                    {this.props.abonnement}
                </td>
            </tr>
        );
    }
});

window.pathSection = pathSection;
